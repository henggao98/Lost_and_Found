<?php
$servername = "dbhost.cs.man.ac.uk";
$username = "j78532kt";
$dbname = "2018_comp10120_z8";

// hash
$sk = 'FlP70KE99DqSZJnI';
$si = 'bMM8RYn0lkr4ijuE';
$k = hash('sha256', $sk);
$iv = substr(hash('sha256', $si), 0, 16);
$password = openssl_decrypt(base64_decode("NG1vRUFFbCtwQUVhZm9lOEhBSklHdz09"), "AES-256-CBC", $k, 0, $iv);


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>