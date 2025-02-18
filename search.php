<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
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
        <h1>Search Books</h1>
        <form action="search.php" method="POST">
            <input type="text" name="query" placeholder="Enter book title or author" required>
            <button type="submit">Search</button>
        </form>

        <div class="results">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require_once 'connect.php'; // Include your database connection
                
                $query = mysqli_real_escape_string($conn, $_POST['query']);
                $result = mysqli_query($conn, "SELECT * FROM books WHERE title LIKE '%$query%' OR author LIKE '%$query%'");

                if (mysqli_num_rows($result) > 0) {
                    echo "<table border='1' width='100%'>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Available</th>
                            </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['title']}</td>
                                <td>{$row['author']}</td>
                                <td>" . ($row['available'] ? 'Yes' : 'No') . "</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No results found.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
