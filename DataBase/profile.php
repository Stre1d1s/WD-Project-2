<?php
session_start();
include("connection.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found!";
    exit();
}

$message = '';
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="profile">
        <h1>User Profile</h1>
        <?php if ($message) : ?>
            <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
            <label>Username: </label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly><br><br>
            <label>First Name: </label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>"><br><br>
            <label>Last Name: </label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>"><br><br>
            <label>Email: </label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br><br>
            <label>Phone: </label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>"><br><br>
            <label>Address: </label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>"><br><br>
            <label>Gender: </label>
            <input type="text" name="gender" value="<?php echo htmlspecialchars($user['gender']); ?>"><br><br>
            <label>Profile Picture: </label>
            <input type="file" name="profile_picture"><br><br>
            <?php if ($user['profile_picture']) : ?>
                <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" width="150"><br><br>
            <?php endif; ?>
            <input type="submit" value="Update Profile">
        </form>
        <h2>Change Password</h2>
        <form action="change_password.php" method="POST">
            <label>Current Password: </label>
            <input type="password" name="current_password" required><br><br>
            <label>New Password: </label>
            <input type="password" name="new_password" required><br><br>
            <input type="submit" value="Change Password" name="submit">
        </form>
    </div>
</body>
</html>

