<?php
  session_start();
  header("Access-Control-Allow-Origin: *");
  $uri = explode("/",$_SERVER['REQUEST_URI']);
  require_once("php/db.php");
  require_once("php/classes/User.php");
  require_once('php/classes/Goods.php');
  if($uri[1]==""){
    $content = file_get_contents("index.html");
  }else if ($uri[1] == "index"){
    $content = file_get_contents("index.html");
  } else if($uri[1]=="about"){
    $content = file_get_contents("about.php");
  } else if ($uri[1] == "reg"){
    $content = file_get_contents("reg.php");
  }else if($uri[1]=="auth"){
    $content = file_get_contents("auth.php");
  }else if($uri[1]=="pay"){
    $content = file_get_contents("pay.html");
  }else if($uri[1]=="single"){
    $content = file_get_contents("single.html");
  }else if($uri[1]=="cart"){
    $content = file_get_contents("cart.html");
  }else if($uri[1]=="contact"){
    $content = file_get_contents("contact.html");
  //}else if($uri[1]=='users'){
  //  $user = User::getUser($_SESSION["id"]);
  //  $content = file_get_contents("lk/lk.php");
  }else if($uri[1] == "addUser"){
    exit(User::addUser($_POST['name'],$_POST['lastname'],$_POST['email'],$_POST['pass']));
  }else if($uri[1] == "authUser"){
    exit(User::authUser($_POST['email'],$_POST['pass']));
  }else if($uri[1]=="getUser"){
    exit(User::getUser($_SESSION['id']));
  }else if($uri[1]=="getUsers"){
    exit(User::getUsers());
  }else if($uri[1]=="changeUserData"){
    exit(User::changeUserData($_SESSION['id'],$_POST['item'],$_POST['value']));

  }else if($uri[1] == "addGoods"){
    exit(Goods::addGoods(
      $_POST['name'],
      $_POST['description'],
      $_POST['goods_in_stock'],
      $_POST['delivery_price'],
      $_POST['retail_price']
    ));
  }else if($uri[1]=="getGoods"){
    exit(Goods::getGoods());
  }else if($uri[1]=="getGoodByIdJSON"){
    exit(Goods::getGoodByIdJSON(3));
  }
  
  else{
    $content = "Page not found";
  }
  
  
  require_once("template.php");
?>