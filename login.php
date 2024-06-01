
<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("connection.php");

$con = connections();

$error_message = ""; // Variable to store error message

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $user = $con->query($sql) or die($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if ($total == 0) {
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];
        header('Location: home.php');
        exit(); // Exit to prevent further execution
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <form action="home.php" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Don't have account yet? <a href="register.php" target="_self">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
