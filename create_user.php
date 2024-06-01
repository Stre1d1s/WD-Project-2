<?php
include("connection.php");

$username = 'your_username';
$password = 'your_password';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password, first_name, last_name, email, phone, address, gender) VALUES ('$username', '$hashed_password', 'John', 'Doe', 'john.doe@example.com', '1234567890', '123 Main St', 'Male')";

if ($conn->query($sql) === TRUE) {
    echo "New user created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
