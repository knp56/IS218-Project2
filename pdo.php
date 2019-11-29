<?php

echo "<h1>PDO demo!</h1>";
$username = 'bcn3_proj';
$password = 'w9hLvRFP';
$hostname = 'sql1.njit.edu';
$dsn = "mysql:host=$hostname;dbname=$username";
try {
    $db = new PDO($dsn, $username, $password);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>

