<?php
session_start();
require_once 'connect.php';

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch counts from the database
$bookCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM books"))['total'];
$usersCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Dashboard</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="sidebar">
        <h2>Library System</h2>
        <ul>
            <li><a href="dashboard.php">🏠 Home</a></li>
            <li><a href="search.php"> 🔍 Search</a></li>
            <li><a href="books.php">📚 Books</a></li>
            <li><a href="borrowed.php">📖 Borrowed Books</a></li>
            <li><a href="users.php">👥 Users</a></li>
            <li><a href="logout.php">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p>Manage your library from here.</p>
        
        <div class="stats">
            <div class="card">
                <h3>Total Books</h3>
                <p><?php echo $bookCount; ?></p>
            </div>
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $usersCount; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
