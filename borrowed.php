<?php
session_start();
require_once 'connect.php'; // Include your database connection

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch borrowed books from the database
$borrowedBooks = mysqli_query($conn, "SELECT * FROM borrowed_books"); // Ensure the table name is correct

// Check if the query was successful
if (!$borrowedBooks) {
    die("Query failed: " . mysqli_error($conn)); // Output the error message if the query fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowed Books</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="sidebar">
        <h2>Library System</h2>
        <ul>
            <li><a href="dashboard.php">🏠 Home</a></li>
            <li><a href="search.php">🔍 Search</a></li>
            <li><a href="books.php">📚 Books</a></li>
            <li><a href="borrowed.php">📖 Borrowed Books</a></li>
            <li><a href="users.php">👥 Users</a></li>
            <li><a href="logout.php">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Borrowed Books</h1>
        <table border="1" width="100%">
            <tr>
                <th>ID</th>
                <th>Book Title</th>
                <th>Borrowed By</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Fine</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($borrowedBooks)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                    <td><?php echo htmlspecialchars($row['borrowed_by']); ?></td>
                    <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['fine']); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>