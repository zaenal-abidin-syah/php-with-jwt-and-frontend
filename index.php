<?php
// api.php

// Autoload composer
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Konfigurasi JWT
$secret_key      = "12345678"; // ganti dengan secret key Anda
$issuer_claim    = "http://yourdomain.com"; // domain penerbit token
$audience_claim  = "http://yourdomain.com"; // domain audience
$issuedat_claim  = time(); // waktu diterbitkan
$notbefore_claim = $issuedat_claim; // token mulai berlaku saat ini
$expire_duration = 3600; // token valid selama 3600 detik (1 jam)

// Koneksi ke database (sesuaikan parameter host, username, password, dbname)
$conn = new mysqli("localhost", "zaens", "zaens", "userjwt");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Tentukan endpoint berdasarkan parameter 'action'
$action = $_GET['action'] ?? '';
header("Access-Control-Allow-Origin: *");
// Mengizinkan metode tertentu
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// Mengizinkan header tertentu
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cache-Control, X-Requested-With");



// Jika request adalah preflight (OPTIONS), hentikan script dan kembalikan status 200
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
header('Content-Type: application/json');

$scriptName = $_SERVER['SCRIPT_NAME'];  
$basePath   = str_replace(basename($scriptName), '', $scriptName);

// Mendapatkan URI request dan menghapus query string (jika ada)
$requestUri = $_SERVER['REQUEST_URI'];
if (($pos = strpos($requestUri, '?')) !== false) {
    $requestUri = substr($requestUri, 0, $pos);
}

// Hapus base path dari URI, jika ada
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

$requestUri = trim($requestUri, '/');
$segments   = explode('/', $requestUri);



if(isset($segments[0]) && $segments[0] === 'register'){
    // Mendapatkan input dari body request (format JSON)
    $data = json_decode(file_get_contents("php://input"));
    $email = trim($data->email ?? '');
    $password = trim($data->password ?? '');
    
    // Cek apakah input kosong
    if(empty($email) || empty($password)){
        http_response_code(400);
        echo json_encode(["message" => "Email dan password harus diisi"]);
        exit();
    }
    
    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $passwordHash);
    if($stmt->execute()){
        http_response_code(201);
        echo json_encode(["message" => "Registrasi berhasil"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Registrasi gagal"]);
    }
    $stmt->close();
}


elseif(isset($segments[0]) && $segments[0] === 'login'){
    // Mendapatkan input dari body request (format JSON)
    $data = json_decode(file_get_contents("php://input"));
    $email = trim($data->email ?? '');
    $password = trim($data->password ?? '');
    
    // Cek apakah input kosong
    if(empty($email) || empty($password)){
        http_response_code(400);
        echo json_encode(["message" => "Email dan password harus diisi"]);
        exit();
    }
    
    // Cek apakah user ada di database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        // Cek password
        if(password_verify($password, $user['password'])){
            // Jika password cocok, generate token JWT dengan masa berlaku
            $token = array(
                "iss"  => $issuer_claim,
                "aud"  => $audience_claim,
                "iat"  => $issuedat_claim,
                "nbf"  => $notbefore_claim,
                "exp"  => $issuedat_claim + $expire_duration, // token expired setelah 1 jam
                "data" => array(
                    "id"    => $user['id'],
                    "email" => $email
                )
            );
            $jwt = JWT::encode($token, $secret_key, 'HS256');
            http_response_code(200);
            echo json_encode(["message" => "Login berhasil", "jwt" => $jwt]);
        } else {
            http_response_code(401);
            echo json_encode(["message" => "Password tidak valid"]);
        }
    } else {
        http_response_code(404);
        echo json_encode(["message" => "User tidak ditemukan"]);
    }
    $stmt->close();
}


elseif(isset($segments[0]) && $segments[0] === 'data'){
    // Mengambil token dari header Authorization (format: Bearer {token})
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    // echo $authHeader;
    if(!$authHeader){
        http_response_code(401);
        echo json_encode(["message" => "Token diperlukan"]);
        exit();
    }
    
    list($bearer, $token) = explode(" ", $authHeader);
    // echo $token;
    if(!$token){
        http_response_code(401);
        echo json_encode(["message" => "Token diperlukan"]);
        exit();
    }
    
    try {
        // Validasi token JWT
        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
        // Jika token valid, proses akses endpoint
        // Tentukan mode operasi dari parameter GET (default: get_all)
        $mode = $_GET['mode'] ?? 'get_all';
        
        if($mode == 'get_all'){
            // a. Get Data All
            $result = $conn->query("SELECT * FROM mahasiswa");
            $dataArray = [];
            while($row = $result->fetch_assoc()){
                $dataArray[] = $row;
            }
            echo json_encode(["message" => "Data berhasil diambil", "data" => $dataArray]);
        }
        elseif($mode == 'filter'){
            // b. Get Data by Filter
            $jurusan = urldecode($_GET['jurusan']) ?? '';
            // echo $jurusan . $mode;
            // return;
            if(empty($jurusan)){
                http_response_code(400);
                echo json_encode(["message" => "Parameter jurusan diperlukan untuk filter"]);
                exit();
            }
            // Pastikan field aman untuk diquery (idealnya menggunakan whitelist field)
            $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE jurusan = ?");
            $stmt->bind_param("s", $jurusan);
            $stmt->execute();
            $result = $stmt->get_result();
            $dataArray = [];
            while($row = $result->fetch_assoc()){
                $dataArray[] = $row;
            }
            echo json_encode(["message" => "Data filter berhasil diambil", "data" => $dataArray]);
            $stmt->close();
        }
        elseif($mode == 'post'){
            // c. Post Data
            // Mendapatkan data dari body request (format JSON)
            $postData = json_decode(file_get_contents("php://input"), true);
            $name = trim($postData['name'] ?? '');
            if(empty($name)){
                http_response_code(400);
                echo json_encode(["message" => "Field name diperlukan"]);
                exit();
            }
            $stmt = $conn->prepare("INSERT INTO data (name) VALUES (?)");
            $stmt->bind_param("s", $name);
            if($stmt->execute()){
                echo json_encode(["message" => "Data berhasil disimpan"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Gagal menyimpan data"]);
            }
            $stmt->close();
        }
        else {
            http_response_code(400);
            echo json_encode(["message" => "Mode tidak valid"]);
        }
    } catch(Exception $e){
        // Jika token tidak valid atau telah expired
        http_response_code(401);
        echo json_encode(["message" => "Token tidak valid atau kadaluarsa", "error" => $e->getMessage()]);
    }
}

// Jika tidak ada action yang cocok
else {
    http_response_code(404);
    echo json_encode(["message" => "Action tidak ditemukan"]);
}

$conn->close();
?>
