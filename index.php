<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Registration Form</title>
</head>

<body class="font-sans bg-gray-100">
  <div class="flex flex-col items-center min-h-screen mt-12">
    
    <!-- Registration Form -->
    <form action="insert.php" method="POST" enctype="multipart/form-data"
      class="bg-white rounded-xl shadow-md mt-10 w-full max-w-2xl p-6">
      <h1 class="text-2xl font-semibold text-center mb-6">Registration Form</h1>

      <input type="text" name="firstname" placeholder="Enter First Name" class="w-full p-2 mb-4 border-b border-gray-400 focus:bg-gray-200 focus:outline-none" required>
      <input type="text" name="lastname" placeholder="Enter Last Name" class="w-full p-2 mb-4 border-b border-gray-400 focus:bg-gray-200 focus:outline-none" required>
      <input type="email" name="email" placeholder="Enter Email" class="w-full p-2 mb-4 border-b border-gray-400 focus:bg-gray-200 focus:outline-none" required>
      <input type="text" name="phone" placeholder="Enter Phone Number" class="w-full p-2 mb-4 border-b border-gray-400 focus:bg-gray-200 focus:outline-none" required>
      <input type="password" name="password" placeholder="Enter Password" class="w-full p-2 mb-4 border-b border-gray-400 focus:bg-gray-200 focus:outline-none" required>
      <input type="file" name="profilepic" class="w-full mb-4 border-b border-gray-400" required>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Register</button>
    </form>

    <!-- Registered Users -->
    <div class="bg-white rounded-xl shadow-md mt-10 w-full max-w-2xl p-6">
      <h2 class="text-2xl font-semibold text-center mb-4">Registered Users</h2>

      <?php
      $sql = "SELECT * FROM users";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "
          <div class='flex justify-between items-center border-b border-gray-300 py-3'>
              <div class='flex items-center space-x-3'>
                  <img src='uploads/{$row['picture']}' alt='Profile' class='w-12 h-12 rounded-full object-cover'>
                  <div>
                      <h3 class='font-medium text-gray-900'>{$row['first_name']} {$row['last_name']}</h3>
                      <p class='text-gray-600 text-sm'>{$row['email']}</p>
                      <p class='text-gray-600 text-sm'>{$row['phone']}</p>
                  </div>
              </div>
              <div class='flex space-x-2'>
                  <button onclick='openEditModal({$row['id']}, \"{$row['first_name']}\", \"{$row['last_name']}\", \"{$row['email']}\", \"{$row['phone']}\")' class='bg-blue-500 text-white text-sm px-3 py-1 rounded-md hover:bg-blue-600 transition'>Edit</button>
                  <button onclick='deleteUser({$row['id']})' class='bg-red-500 text-white text-sm px-3 py-1 rounded-md hover:bg-red-600 transition'>Delete</button>
              </div>
          </div>";
        }
      } else {
        echo "<p class='text-center text-gray-500'>No users registered yet.</p>";
      }
      ?>
    </div>
  </div>

  <!-- Edit Modal -->
  <div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-80">
          <h3 class="text-lg font-semibold mb-4 text-center">Edit User</h3>
          <form id="editForm">
              <input type="hidden" id="editId">
              <label class="block text-sm mb-1">First Name</label>
              <input type="text" id="editFirst" class="w-full p-2 mb-3 border border-gray-300 rounded">

              <label class="block text-sm mb-1">Last Name</label>
              <input type="text" id="editLast" class="w-full p-2 mb-3 border border-gray-300 rounded">

              <label class="block text-sm mb-1">Email</label>
              <input type="text" id="editEmail" class="w-full p-2 mb-3 border border-gray-300 rounded">

              <label class="block text-sm mb-1">Phone</label>
              <input type="text" id="editPhone" class="w-full p-2 mb-4 border border-gray-300 rounded">

              <div class="flex justify-end space-x-2">
                  <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-800 px-3 py-1 rounded hover:bg-gray-400 transition">Cancel</button>
                  <button type="button" onclick="saveEdit()" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Save</button>
              </div>
          </form>
      </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
