<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$first = $data['first'];
$last = $data['last'];
$email = $data['email'];
$phone = $data['phone'];

$sql = "UPDATE users SET first_name='$first', last_name='$last', email='$email', phone='$phone' WHERE id=$id";
$conn->query($sql);
?>
