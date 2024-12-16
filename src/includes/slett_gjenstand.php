<?php
$tilkobling = new SQLite3(filename: __DIR__ . '/../resources/db/fleamrk.db');

$sql = sprintf("DELETE FROM bilder WHERE gjenstandID=%s",
$tilkobling->escapeString($_GET["itemID"]));
$tilkobling->exec($sql);
print $sql;

$sql2 = sprintf("DELETE FROM favoritt WHERE itemID=%s",
$tilkobling->escapeString($_GET["itemID"]));
$tilkobling->exec($sql2);
print $sql2;

$sql3 = sprintf("DELETE FROM item WHERE itemID=%s",
$tilkobling->escapeString($_GET["itemID"]));
$tilkobling->exec($sql3);
print $sql3;

header("Location:../pages/main.php");
?>