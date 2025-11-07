<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $target_dir = "uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir);
    $target_file = $target_dir . basename($_FILES["profilepic"]["name"]);
    move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file);

    $pic = basename($_FILES["profilepic"]["name"]);

    $sql = "INSERT INTO users (first_name, last_name, email, phone, password, picture)
            VALUES ('$first', '$last', '$email', '$phone', '$password', '$pic')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
