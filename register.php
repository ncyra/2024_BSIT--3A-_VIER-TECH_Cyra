

<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once("connection.php");

$con = connections();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate if passwords match
    if ($password != $confirmPassword) {
        echo "Passwords do not match.";
        exit(); // Stop further execution
    }

    // Hash the password (use a secure hashing algoriythm like bcrypt)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert user data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
    if ($con->query($sql) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit(); // Stop further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Register</title>
</head>
<body>
    <div class="wrapper register-link">
        <form action="register.php" method="post">
            <h1>Sign Up</h1>
            <div class="input-box">
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" id="email" name="email" placeholder="Enter your email address" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <!-- for registration button -->
            <button type="submit" class="btn">Register</button>
            
            <div class="register-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
            
        </form>
    </div>
</body>
</html>
