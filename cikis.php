<?php
require_once("veritabani.php");
$sorgu = "DROP table network";
$sorgu2 = "DROP table profil";
$sorgu3 = "DROP table liste";
$conn->query($sorgu);
$conn->query($sorgu2);
$conn->query($sorgu3);
header("Location: index.php");
 ?>