<?php

$conn = require_once( 'dbConnect.php');

$sql = "SELECT * FROM parts";
$result = $conn->query($sql);

return $result;