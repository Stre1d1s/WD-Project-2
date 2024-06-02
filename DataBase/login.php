<?php
include("connection.php");
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['username'] = $username;
        header("Location: profile.php");
    } else {
        echo '<script>
                window.location.href = "login.php";
                alert("Login failed. Invalid username or password!!")
              </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="form">
        <h1>Login Form</h1>
        <form name="form" action="login.php" onsubmit="return isvalid()" method="POST">
            <label>Username: </label>
            <input type="text" id="user" name="user"> </br></br>
            <label>Password</label>
            <input type="password" id="pass" name="pass">
            <input type="submit" id="btn" value="login" name="submit">
        </form>
    </div>
    <script>
        function isvalid(){
            var user = document.form.user.value;
            var pass = document.form.pass.value;
            if(user.length=="" && pass.length==""){
                alert("Username and password field is empty!!");
                return false
            }
            else{
                if(user.length==""){
                    alert("Username is empty!!");
                    return false
                }
                if(pass.length==""){
                    alert("Password is empty!!");
                    return false
                }
            }
        }
    </script>
</body>
</html>