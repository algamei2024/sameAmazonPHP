<?php
$s = "localhost";
$u = "root";
$p = "";
$db = "amazon";
$con = new mysqli($s , $u , $p , $db);
function test($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
 $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
?>