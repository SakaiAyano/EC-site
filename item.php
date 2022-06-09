<?php
class Item{
  private $id;
  private $name;
  private $image;
  private $price;
  private $body;//商品の説明に関するカラムだがここ以外まだ何も設定していない
  private static $item_cnt=0;

  public function __construct($id,$name,$image,$price){
    $this->id = $id;
    $this->name = $name;
    $this->image = $image;
    $this->price = $price;
    self::$item_cnt++;
  }

  public static function getCount(){
    return self::$item_cnt;
  }

  public static function getFindById($items,$id){
    foreach($items as $item){
      if($item->getId() == $id){
        return $item;
      }
    }
  }

  public function getId(){
    return $this->id;
  }

  public function getName(){
    return $this->name;
  }

  public function getImage(){
    return $this->image;
  }

  public function getPrice(){
    return $this->price;
  }
}
?>
