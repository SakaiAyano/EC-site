<?php
require_once('item.php');

//[items]

$dsn = 'mysql:dbname=ec-site;host=localhost';
$user = 'root';
$password = '';

$dbh = new PDO($dsn, $user, $password);
$sql = 'SELECT * FROM item';

$items = array();
foreach ($dbh->query($sql) as $row) {
  $item=new Item($row['id'],$row['name'],$row['image'],$row['price']);
  array_push($items,$item);
}
?>
