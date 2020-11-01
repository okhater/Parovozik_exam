<?php

class Goods{
  private $name;
  private $deskn;
  private $gistock;
  private $dprice;
  private $rprice;
  function __construct($name, $deskn, $gistock, $dprice, $rprice){
    $this->name = $name;
    $this->description = $deskn;
    $this->goods_in_stock = $gistock;
    $this->delivery_price = $dprice;
    $this->retail_price = $rprice;
  }
  function getName(){return $this->name;}
  function getDescription(){return $this->description;}
  function getGoods_in_stock(){return $this->goods_in_stock;}
  function getDelivery_price(){return $this->delivery_price;}
  function getRetail_price(){return $this->retail_price;}
  
  static function addGoods($name, $deskn, $gistock, $dprice, $rprice){
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO `product_database_train` (`name`, `description`, `goods_in_stock`, `delivery_price`, `retail_price`) VALUES (?,?,?,?,?)");
    $stmt->bind_param("ssidd", $name, $deskn, $gistock, $dprice, $rprice);
    $stmt->execute();
    $stmt->close();
    return "success";
  }
  
  static function getGoods(){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM `product_database_train` WHERE 1");
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return json_encode($data);
  }
  
  static function getGoodByIdJSON($goodId){
      global $mysqli;
      $stmt = $mysqli->prepare("SELECT * FROM `product_database_train` WHERE `id`=?");
      $stmt->bind_param('i',$goodId);
      $stmt->execute();
      $result = $stmt->get_result();
      $data = $result->fetch_assoc();
      return json_encode( $data );
  }
}


?>