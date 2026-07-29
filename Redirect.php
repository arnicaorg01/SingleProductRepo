<?php
// test_vulnerable.php
// INTENTIONALLY VULNERABLE - FOR SAST TESTING ONLY

// ------------------------------
// SQL Injection
// ------------------------------
$conn = new mysqli("localhost", "root", "password", "testdb");

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($sql);

// ------------------------------
// Command Injection
// ------------------------------
$host = $_GET['host'];
$output = shell_exec("ping -c 4 " . $host);
echo "<pre>$output</pre>";

// ------------------------------
// Cross-Site Scripting (XSS)
// ------------------------------
$name = $_GET['name'];
echo "Welcome " . $name;

// ------------------------------
// Local File Inclusion (LFI)
// ------------------------------
$page = $_GET['page'];
include($page);

// ------------------------------
// Insecure Deserialization
// ------------------------------
$data = $_POST['data'];
$obj = unserialize($data);

// ------------------------------
// Arbitrary File Upload
// ------------------------------
move_uploaded_file(
    $_FILES["file"]["tmp_name"],
    "uploads/" . $_FILES["file"]["name"]
);

// ------------------------------
// Hardcoded Credentials
// ------------------------------
$apiKey = "1234567890abcdef";
$password = "SuperSecretPassword!";

// ------------------------------
// Weak Random Number Generation
// ------------------------------
$token = md5(rand());

// ------------------------------
// Weak Hashing
// ------------------------------
$userPassword = $_POST['password'];
$hash = md5($userPassword);

// ------------------------------
// Open Redirect
// ------------------------------
header("Location: " . $_GET['redirect']);

// ------------------------------
// Dangerous eval()
// ------------------------------
$code = $_POST['code'];
eval($code);

// ------------------------------
// Path Traversal
// ------------------------------
$file = $_GET['file'];
$content = file_get_contents("/var/www/files/" . $file);
echo $content;

// ------------------------------
// Information Disclosure
// ------------------------------
phpinfo();

?>
