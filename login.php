<?php
    include("connection.php");
    session_start();

    if(isset($_POST['submit'])){
        $username = $_POST['inputUsername'];
        $password = $_POST['inputPassword'];

        $sql = "SELECT * FROM users WHERE username = '$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if($row && $password == $row['password']){
            $_SESSION['username'] = $username;
            header("Location: profile.php");
        }
        else{
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
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div id="form">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                <div class="card-body">
                                    <form name="form" action="login.php" onsubmit="return isvalid()" method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputUsername" name="inputUsername" type="text" placeholder="Username" />
                                            <label for="inputUsername">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <input class="btn btn-dark" type="submit" id="btn" value="Login" name="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function isvalid(){
            var inputUsername = document.form.inputUsername.value;
            var inputPassword = document.form.inputPassword.value;
            if(inputUsername.length=="" && inputPassword.length==""){
                alert("Username and password field is empty!!");
                return false
            }
            else{
                if(inputUsername.length==""){
                    alert("Username is empty!!");
                    return false
                }
                if(inputPassword.length==""){
                    alert("Password is empty!!");
                    return false
                }
            }
        }
    </script>
</body>
</html>