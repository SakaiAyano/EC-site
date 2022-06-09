<?php
require_once('data.php');
$item_id=isset($_GET['item_id'])?$_GET['item_id']:'';
$item = Item::getFindById($items,$item_id);


$id=isset($_POST['id'])?$_POST['id']:'';
$count=isset($_POST['count'])?$_POST['count']:'';

session_start();
if(isset($_SESSION['products'])){
  $products=$_SESSION['products'];
  foreach($products as $key => $value){
  if($id==$key){
    $count=(int)$count + (int)$value['count'];
  }
  }
}

if($id!='' && $count!=''){
  $_SESSION['products'][$id]=[
    'count'=>$count
  ];
}

$products=isset($_SESSION['products'])?$_SESSION['products']:[];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>商品詳細ページ</title>
    <link rel="stylesheet" href="css/stylesheet.css">
  </head>
  <body>
    <header><img src='images/header.jpg' class='header-banner'></header>
    <div class='item-show'>
    <div class='item'>
    <form class="" action="show.php?item_id=<?php echo $item->getId() ?>" method="post">
      <img src='images/items/<?php echo $item->getImage() ?>' class='item-image'>
      <p><?php echo $item->getName()?></p>
      <p><?php echo $item->getPrice() ?>円</p>
      <input type="hidden" name="id" value="<?php echo $item->getId() ?>">
      <input type='text' name='count' value='0'>個
      <input type='submit' value='カートに入れる' class='curt-button'>
    </form>

    <?php if(isset($products)): ?>
      <?php foreach($products as $key=>$value): ?>
        <p><?php echo $key?></p><!--商品id-->
        <br>
        <p><?php echo $value['count'] ?></p>
        <br>
      <?php endforeach?>
    <?php endif ?>

    </div>
    </div>

    <footer></footer>
  </body>
</html>
