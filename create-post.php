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

// Get data from the client (assuming it's a JSON payload)
$data = json_decode(file_get_contents("php://input"), true);

// Sanitize the data (avoid SQL injection)
$title = mysqli_real_escape_string($conn, $data['title']);
$content = mysqli_real_escape_string($conn, $data['content']);

// Insert the data into the database
$sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";

if ($conn->query($sql) === TRUE) {
    $response = array('success' => true, 'message' => 'Post created successfully');
} else {
    $response = array('success' => false, 'message' => 'Error creating post: ' . $conn->error);
}

$conn->close();

// Send the response back to the client
header('Content-Type: application/json');
echo json_encode($response);

?>
