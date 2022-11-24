<?php
if (file_exists( './vendor/autoload.php')) {
    require_once( './vendor/autoload.php');
}
$conn = require_once( 'dbConnect.php');

$sql = "SELECT * FROM parts";
$result = $conn->query($sql);

return $result;