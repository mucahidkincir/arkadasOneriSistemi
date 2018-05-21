
<?php
$servername = "94.138.203.35";
$username = "mucahitkincir";
$password = "?????????????";
$dbname = "mucahitkincir";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$conn->query("SET NAMES UTF8");
$conn->query("SET CHARACTER SET utf8_general_ci");
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS `profil` (
  `profilId` int(11) NOT NULL AUTO_INCREMENT,
  `ogrenciNo` varchar(10) NOT NULL,
  `secim1` int(11) NOT NULL,
  `secim2` int(11) NOT NULL,
  `secim3` int(11) NOT NULL,
  `secim4` int(11) NOT NULL,
  `secim5` int(11) NOT NULL,
  `secim6` int(11) NOT NULL,
  `secim7` int(11) NOT NULL,
  `secim8` int(11) NOT NULL,
  `secim9` int(11) NOT NULL,
  `secim10` int(11) NOT NULL,
  `secim11` int(11) NOT NULL,
  `secim12` int(11) NOT NULL,
  `secim13` int(11) NOT NULL,
  `secim14` int(11) NOT NULL,
  `secim15` int(11) NOT NULL,
  PRIMARY KEY (`profilId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$sql2 = "CREATE TABLE IF NOT EXISTS `network` (
  `networkId` int(11) NOT NULL AUTO_INCREMENT,
  `ogrenciNo` varchar(10) NOT NULL,
  `ogrNo1` int(11) NOT NULL,
  `ogrNo2` int(11) NOT NULL,
  `ogrNo3` int(11) NOT NULL,
  `ogrNo4` int(11) NOT NULL,
  `ogrNo5` int(11) NOT NULL,
  `ogrNo6` int(11) NOT NULL,
  `ogrNo7` int(11) NOT NULL,
  `ogrNo8` int(11) NOT NULL,
  `ogrNo9` int(11) NOT NULL,
  `ogrNo10` int(11) NOT NULL,
  PRIMARY KEY (`networkId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$sql3 = "CREATE TABLE IF NOT EXISTS `liste` (
  `listeId` int(11) NOT NULL AUTO_INCREMENT,
  `ogrenciNo` varchar(10) NOT NULL,
  `adSoyad` varchar(50) NOT NULL,
  PRIMARY KEY (`listeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "<script>alert('Veritabanı Hatası');</script>";
}

if ($conn->query($sql2) === TRUE) {
    echo "";
} else {
    echo "<script>alert('Veritabanı Hatası');</script>";
}

if ($conn->query($sql3) === TRUE) {
    echo "";
} else {
    echo "<script>alert('Veritabanı Hatası');</script>";
}

?>
