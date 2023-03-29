<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <title>Student Management System </title>
</head>

<body>
    <div class="login-page">

<div class="form">
<form class="login-form" method="post" action="" name="signup-form">
<h4 class="login-title">Admin User Registration</h4>
    <div class="form-element">
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required  placeholder="Username"/>
    </div>
    <div class="form-element">
        <input type="email" name="email" placeholder="Email" required />
    </div>
    <div class="form-element">
        <input type="password" name="password" required placeholder="Password" />
    </div>
    <button type="submit" name="register" value="register">Register</button>
</form>
</div>
<?php
session_start();
include('inc/config.php');
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo '<p class="error">The email address is already registered!</p>';
    }
    if ($query->rowCount() == 0) {
        $query = $connection->prepare("INSERT INTO users(username,password,email) VALUES (:username,:password_hash,:email)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
            echo '<p class="success">Your registration was successful!</p>';
        } else {
            echo '<p class="error">Something went wrong!</p>';
        }
    }
}
?>


</body>

</html>