<?php
require_once('data.php');
$item_cnt=Item::getCount();//トータルデータ件数
$page_item=12;
$max_page=ceil($item_cnt/$page_item);//トータルページ数 ceil関数は小数点を切り上げにする関数

if(!isset($_GET['page_id'])){
  $now = 1;
}else{
  $now = $_GET['page_id'];
}

$start_no = ($now-1)*$page_item;//配列の何番目から取得すればいいか
$item_data = array_slice($items, $start_no, $page_item, true);

//現在の時刻を取得して挨拶文を変更する
$now_h = date('H');
if($now_h>=5 && $now_h<=11){
  $hello = "おはようございます";
}elseif($now_h>=12 && $now_h<=17){
  $hello = "こんにちは";
}else{
  $hello = "こんばんは";
}

session_start();
$id = $_SESSION['id'];
$name = $_SESSION['name_f']." ".$_SESSION['name_l'];

?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>商品ページ</title>
    <link rel="stylesheet" href="css/stylesheet.css">
  </head>
  <body>
    <header>
      <img src='images/header.jpg' class='header-banner'>
      <div class="log-out">
        <a href="logout.php">ログアウト</a>
      </div>
      <div class="welcome-hello">
       <p><?php echo $hello?></p>
       <p><?php echo $name?>様</P>
      </div>
    </header>
    <main>
      <div class='container'>
      <h1>商品一覧ページ</h1>
      <p class="pageing">
      <?php if($now == 1): ?>
      <?php else: ?>
      <a href='index.php?page_id=<?php echo $now-1 ?>'><<前へ</a>
      <?php endif ?>
      <?php for($i=1; $i<=$max_page; $i++): ?>
        <?php if($i==$now): ?>
          <?php echo $now ?>
        <?php else: ?>
          <a href='index.php?page_id=<?php echo $i ?>'><?php echo $i?></a>
        <?php endif ?>
      <?php endfor ?>
      <?php if($now == $max_page): ?>
      <?php else: ?>
      <a href='index.php?page_id=<?php echo $now+1?>'>次へ>></a>
      <?php endif ?>
      </p>

      <div class='item-list'>
      <?php foreach($item_data as $item): ?>
      <div class='item'>
      <a href='show.php?item_id=<?php echo $item->getId()?>'><img src='images/items/<?php echo $item->getImage() ?>' class='item-image'></a>
      <a href='show.php?item_id=<?php echo $item->getId()?>'><p><?php echo $item->getName()?></p></a>
      <a href='show.php?item_id=<?php echo $item->getId()?>'><p><?php echo $item->getPrice() ?>円</p></a>
      </div>
      <?php endforeach ?>
      </div>

      <p class="pageing">
      <?php if($now == 1): ?>
      <?php else: ?>
      <a href='index.php?page_id=<?php echo $now-1 ?>'><<前へ</a>
      <?php endif ?>
      <?php for($i=1; $i<=$max_page; $i++): ?>
        <?php if($i==$now): ?>
          <?php echo $now ?>
        <?php else: ?>
          <a href='index.php?page_id=<?php echo $i ?>'><?php echo $i?></a>
        <?php endif ?>
      <?php endfor ?>
      <?php if($now == $max_page): ?>
      <?php else: ?>
      <a href='index.php?page_id=<?php echo $now+1?>'>次へ>></a>
      <?php endif ?>
      </p>

      </div>
    </main>
    <footer></footer>
  </body>
</html>
