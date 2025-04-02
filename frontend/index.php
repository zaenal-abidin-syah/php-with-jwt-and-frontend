<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JWT API Frontend</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .message {
      transition: opacity 0.5s ease-in-out;
    }
  </style>
</head>
<body class="bg-gray-100">
  <nav class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
      <a href="/" class="text-xl font-bold">JWT Frontend</a>
      <div id="navLinks">
        <a href="/dashboard" class="hover:text-blue-200 mr-4">Dashboard</a>
        <a href="/login" class="hover:text-blue-200 mr-4">Login</a>
        <a href="/register" class="hover:text-blue-200">Register</a>
      </div>
    </div>
  </nav>
  <div class="container mx-auto p-4">

<div class="bg-white rounded-lg shadow-md p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h2>
    <button onclick="logout()" 
            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">
      Logout
    </button>
  </div>

  <div id="messages" class="message mb-4"></div>

  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <button onclick="fetchData()" 
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
      Semua Jurusan
    </button>
    <button onclick="fetchData('Teknik Mesin')" 
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
      Teknik Mesin
    </button>
    <button onclick="fetchData('Teknik Informatika')" 
            class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600 transition duration-300">
      Teknik Informatika
    </button>
    <button onclick="fetchData('Teknik Elektro')" 
            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">
      Teknik Elektro
    </button>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
        </tr>
      </thead>
      <tbody id="mahasiswaTable" class="bg-white divide-y divide-gray-200">
        <!-- Data akan dimasukkan di sini -->
      </tbody>
    </table>
  </div>
</div>

<script src="/js/data.js"></script>
  </div>
  </body>
  <script src="/js/utils.js"></script>
</html>