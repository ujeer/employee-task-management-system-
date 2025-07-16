<?php
include "DB_connection.php";

$stmt = $conn->query("SELECT id, password FROM users");
$users = $stmt->fetchAll();

foreach ($users as $user) {
    $id = $user['id'];
    $plainPassword = $user['password'];
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    $update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $update->execute([$hashedPassword, $id]);

    echo "Updated password for user ID $id<br>";
}

echo "All passwords updated!";
