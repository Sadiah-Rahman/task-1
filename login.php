<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['first_name'] . " " . $row['last_name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with this email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login</title>
</head>
<body class="font-sans bg-gray-100">
  <div class="flex flex-col justify-center items-center min-h-screen">

    <!-- Login Form -->
    <form action="" method="POST" class="bg-white rounded-xl shadow-md w-full max-w-md p-6">
      <h1 class="text-2xl font-semibold text-center mb-6">User Login</h1>

      <?php if ($error): ?>
        <p class="text-red-500 text-center mb-4"><?= $error ?></p>
      <?php endif; ?>

      <input type="email" name="email" placeholder="Enter Email"
        class="w-full p-2 mb-4 border-b border-gray-400 focus:bg-gray-200 focus:outline-none" required>

      <input type="password" name="password" placeholder="Enter Password"
        class="w-full p-2 mb-4 border-b border-gray-400 focus:bg-gray-200 focus:outline-none" required>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
        Login
      </button>

      <p class="text-center text-gray-600 mt-4">
        Don't have an account?
        <a href="index.php" class="text-blue-500 hover:underline">Register here</a>
      </p>
    </form>

  </div>
</body>
</html>
