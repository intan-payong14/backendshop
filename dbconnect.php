<?php
define('DB_HOST', 'interchange.proxy.rlwy.net'); 
define('DB_USER', 'root');      
define('DB_PASS', 'hJHRdMpBByXMiBbMhuWNOmjKLYnWijfu');          
define('DB_NAME', 'railway'); 
define('DB_PORT', 42188);

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
