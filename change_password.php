<?php
include("connection.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $username = $_SESSION['username'];

    $current_password = mysqli_real_escape_string($conn, $current_password);
    $new_password = mysqli_real_escape_string($conn, $new_password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$current_password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $sql_update = "UPDATE users SET password='$new_password' WHERE username='$username'";
        if (mysqli_query($conn, $sql_update)) {
            header("Location: profile.php?msg=Password updated successfully.");
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
    } else {
        echo "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="form">
        <h1>Change Password</h1>
        <form name="form" action="change_password.php" method="POST">
            <label>Current Password: </label>
            <input type="password" id="current_password" name="current_password"> </br></br>
            <label>New Password: </label>
            <input type="password" id="new_password" name="new_password">
            <input type="submit" id="btn" value="Change Password" name="submit">
        </form>
    </div>
</body>
</html>

