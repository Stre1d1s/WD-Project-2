<?php
    include("connection.php");

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $profile_picture = $_FILES['profile_picture']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

        $sql = "INSERT INTO users (username, password, first_name, last_name, email, phone, address, gender, profile_picture) VALUES ('$username', '$password', '$first_name', '$last_name', '$email', '$phone', '$address', '$gender', '$profile_picture')";

        if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="form">
        <h1>Register Form</h1>
        <form name="form" action="register.php" onsubmit="return isvalid()" method="POST" enctype="multipart/form-data">
            <label>Username: </label>
            <input type="text" id="username" name="username"> </br></br>
            <label>Password: </label>
            <input type="password" id="password" name="password"> </br></br>
            <label>First Name: </label>
            <input type="text" id="first_name" name="first_name"> </br></br>
            <label>Last Name: </label>
            <input type="text" id="last_name" name="last_name"> </br></br>
            <label>Email: </label>
            <input type="email" id="email" name="email"> </br></br>
            <label>Phone: </label>
            <input type="text" id="phone" name="phone"> </br></br>
            <label>Address: </label>
            <input type="text" id="address" name="address"> </br></br>
            <label>Gender: </label>
            <input type="text" id="gender" name="gender"> </br></br>
            <label>Profile Picture: </label>
            <input type="file" id="profile_picture" name="profile_picture"> </br></br>
            <input type="submit" id="btn" value="Register" name="submit">
        </form>
    </div>
</body>
</html>