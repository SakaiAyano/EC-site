<?php
require_once('db.php');
require_once('item.php');


//商品一覧のデータを取得[items]
$sql = 'SELECT * FROM item';
$items = array();
$dbh=DB::connectDB();
foreach ($dbh->query($sql) as $row) {
  $item=new Item($row['id'],$row['name'],$row['image'],$row['price']);
  array_push($items,$item);
}

?>
