<?php
$tilkobling=mysqli_connect ("localhost","root","", "fleamrk");

$sql=sprintf("DELETE FROM `fleamrk`.`bilder` WHERE gjenstandID=%s",
$tilkobling->real_escape_string($_GET["itemID"]));
$datasett=$tilkobling->query($sql);
print $sql;

$sql2=sprintf("DELETE FROM `fleamrk`.`favoritt` WHERE itemID=%s",
$tilkobling->real_escape_string($_GET["itemID"]));
$datasett2=$tilkobling->query($sql2);
print $sql2;

$sql3=sprintf("DELETE FROM `fleamrk`.`item` WHERE itemID=%s",
$tilkobling->real_escape_string($_GET["itemID"]));
$datasett3=$tilkobling->query($sql3);
print $sql3;

header("Location:main.php");


?>