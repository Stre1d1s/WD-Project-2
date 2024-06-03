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
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">User Profile</h3></div>
                                <div class="card-body">
                                    <?php if ($message) : ?>
                                        <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
                                    <?php endif; ?>
                                    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputUsername" type="text" placeholder="Username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>"/>
                                            <label for="inputUsername">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputFirstName" type="text" placeholder="First Name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>"/>
                                            <label for="inputFirstName">First Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputLastName" type="text" placeholder="Last Name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>"/>
                                            <label for="inputLastName">Last Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" placeholder="Email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"/>
                                            <label for="inputEmail">Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPhone" type="text" placeholder="Phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>"/>
                                            <label for="inputPhone">Phone</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputAddress" type="text" placeholder="Address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>"/>
                                            <label for="inputAddress">Address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputGender" type="text" placeholder="Gender" name="gender" value="<?php echo htmlspecialchars($user['gender']); ?>"/>
                                            <label for="inputGender">Gender</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputProfilePicture" type="file" placeholder="Profile Picture" name="profile_picture"/>
                                            <label for="inputProfilePicture">Profile Picture</label>
                                        </div>
                                        <?php if ($user['profile_picture']) : ?>
                                            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" width="150"><br><br>
                                        <?php endif; ?>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <input class="btn btn-dark" type="submit" value="Update Profile" name="submit">
                                        </div>
                                        <br>
                                    </form>
                                    <div class="card-footer"><h3 class="text-center font-weight-light my-4">Change Password</h3></div>
                                    <form action="change_password.php" method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputCurrentPassword" type="password" placeholder="Current Password" name="current_password" required/>
                                            <label for="inputCurrentPassword">Current Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputNewPassword" type="password" placeholder="New Password" name="new_password" required/>
                                            <label for="inputNewPassword">New Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <input class="btn btn-dark" type="submit" value="Change Password" name="submit">
                                        </div>
                                    </form>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-dark" onclick="window.location.href='index.php';">Back to Home</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
