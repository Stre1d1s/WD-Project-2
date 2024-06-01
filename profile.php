<?php
include("connection.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $profile_picture = $_FILES['profile_picture']['name'];

    if ($profile_picture != "") {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', gender='$gender', profile_picture='$profile_picture' WHERE username='$username'";
    } else {
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', gender='$gender' WHERE username='$username'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

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
        <h1>Profile</h1>
        <form name="form" action="profile.php" method="POST" enctype="multipart/form-data">
            <label>Username: </label>
            <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" readonly> </br></br>
            <label>First Name: </label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>"> </br></br>
            <label>Last Name: </label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>"> </br></br>
            <label>Email: </label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"> </br></br>
            <label>Phone: </label>
            <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>"> </br></br>
            <label>Address: </label>
            <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>"> </br></br>
            <label>Gender: </label>
            <input type="text" id="gender" name="gender" value="<?php echo $row['gender']; ?>"> </br></br>
            <label>Profile Picture: </label>
            <input type="file" id="profile_picture" name="profile_picture"> </br></br>
            <input type="submit" id="btn" value="Update" name="submit">
        </form>
    </div>
</body>
</html>