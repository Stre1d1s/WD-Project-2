<?php
include("connection.php");

$username = 'icsd21049';
$password = '21049';  

$sql = "INSERT INTO users (username, password, first_name, last_name, email, phone, address, gender) VALUES ('$username', '$password', 'Takis', 'Eksipnakis', 'Takis@example.com', '2294857630', 'enas kados sto karlobasi', 'Male')";

if ($conn->query($sql) === TRUE) {
    echo "New users created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
