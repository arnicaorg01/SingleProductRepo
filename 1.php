<?php
// Hardcoded credentials - CWE-798
$db_user = "admin";
$db_pass = "password123";

// Connect to MySQL
$conn = mysqli_connect("localhost", $db_user, $db_pass, "test_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user input from GET request
$user = $_GET['user'];
$filename = $_GET['file'];

// SQL Injection - CWE-89
$sql = "SELECT * FROM users WHERE username = '$user'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "User: " . $row['username'] . "<br>";
}

// Command Injection - CWE-78
$cmd = "ls " . $filename;
$output = shell_exec($cmd);
echo "<pre>$output</pre>";

