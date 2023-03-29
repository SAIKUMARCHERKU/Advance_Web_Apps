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
            <form class="login-form" method="post" action="" name="signin-form">
                <h4 class="login-title">Admin Login</h4>
                <input type="text" placeholder="username" name="username" pattern="[a-zA-Z0-9]+" required />
                <input type="password" placeholder="password" name="password" required />
                <button type="submit" name="login" value="login">login</button>
            </form>
            <div class="login-links">
                <a href="student-login.php">Student Login</a>
                <a href="professor-login.php">Professor Login</a>
            </div>
        </div>
    </div>

    <?php
    session_start();
    include('inc/config.php');
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<div class="login-error"><p class="error">Username password combination is wrong!</p></div>';
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user_id'] = $result['id'];
                echo '<p class="success">Congratulations, you are logged in!</p>';

                header('Location: dashboard.php');

            } else {
                echo '<div class="login-error"><p class="error">Username password combination is wrong!</p></div>';
            }
        }
    }
    ?>
</body>

</html>