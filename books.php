<?php
session_start();
require_once 'connect.php';

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch books from the database
$books = mysqli_query($conn, "SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="sidebar">
        <h2>Library System</h2>
        <ul>
            <li><a href="dashboard.php">🏠 Home</a></li>
            <li><a href="books.php">📚 Books</a></li>
            <li><a href="borrowed.php">📖 Borrowed Books</a></li>
            <li><a href="users.php">👥 Users</a></li>
            <li><a href="logout.php">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Books Available</h1>
        <table border="1" width="100%">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Available</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($books)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo ($row['available']); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>