<?php
session_start();
include("connection.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['username'])) {
    $username = $_SESSION['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $address = mysqli_real_escape_string($conn, $address);
    $gender = mysqli_real_escape_string($conn, $gender);

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', gender='$gender' WHERE username='$username'";

    if (mysqli_query($conn, $sql)) {
        header("Location: profile.php?msg=Profile updated successfully.");
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>
