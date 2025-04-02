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

<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
  <h2 class="text-2xl font-bold mb-6 text-gray-800">Login</h2>
  <div id="messages" class="message mb-4"></div>
  
  <form id="loginForm" class="space-y-4">
    <div>
      <label class="block text-gray-700 mb-2">Email</label>
      <input type="email" name="email" 
             class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
             required>
    </div>
    
    <div>
      <label class="block text-gray-700 mb-2">Password</label>
      <input type="password" name="password" 
             class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
             required>
    </div>
    
    <button type="submit" 
            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
      Login
    </button>
  </form>
  
  <p class="mt-4 text-center">
    Belum punya akun? 
    <a href="/register" class="text-blue-600 hover:underline">Daftar disini</a>
  </p>
</div>

<script src="/js/auth.js"></script>
  </div>
  </body>
  <script src="/js/utils.js"></script>
</html>