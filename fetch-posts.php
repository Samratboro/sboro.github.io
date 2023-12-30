<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch blog posts from the database
$sql = "SELECT id, title, content, created_at FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check if there are posts
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<article>";
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>" . $row["content"] . "</p>";
        echo "<p><em>Posted on: " . $row["created_at"] . "</em></p>";
        echo "</article>";
    }
} else {
    echo "No blog posts yet.";
}

$conn->close();

?>
