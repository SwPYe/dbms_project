<?php
session_start();
require_once('connect.php');

if (isset($_POST['submit'])) {
    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    // Check if username exists
    $usernamequery = "SELECT * FROM signup WHERE username='$username'";
    $query = mysqli_query($conn, $usernamequery);

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['message'] = "User Already Exists!";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert into database
        $insertquery = "INSERT INTO signup (username, password) VALUES ('$username', '$hashedPassword')";
        if (mysqli_query($conn, $insertquery)) {
            $_SESSION['message'] = "Account Created Successfully! Please log in.";
            header("Location: login.php"); // Redirect to login page
            exit();
        } else {
            $_SESSION['message'] = "Error: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 { text-align: center; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; border-radius: 4px; }
        button { background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <?php if (isset($_SESSION['message'])) { echo '<p class="error">'.$_SESSION['message'].'</p>'; unset($_SESSION['message']); } ?>
        <form method="POST">
            <input type="text" placeholder="Enter your username" name="username" required>
            <input type="password" placeholder="Enter your password" name="password" required>
            <button type="submit" name="submit">Create Account</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>