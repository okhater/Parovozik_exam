<?php

class User{
  private $name;
  private $lastname;
  private $email;
  private $id;
  function __construct($name,$lastname,$email,$id){
    $this->name = $name;
    $this->lastname = $lastname;
    $this->email = $email;
    $this->id = $id;
  }
  function getName(){return $this->name;}
  function getLastname(){return $this->lastname;}
  function getEmail(){return $this->email;}
  function getId(){return $this->id;}
  
    static function addUser($name,$lastname,$email,$pass){
    global $mysqli;
    $email = mb_strtolower(trim($email));
    $pass = password_hash(trim($pass), PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `email`=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows){
      return "exist";
    }else{
      $stmt = $mysqli->prepare("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES (?,?,?,?)");
      $stmt->bind_param("ssss",$name,$lastname,$email,$pass);
      $stmt->execute();
      $stmt->close();
      return "success";
    }
  }
  
    static function authUser($email,$pass){
    global $mysqli;
    $email = mb_strtolower(trim($email));
    $pass = trim($pass);
    $stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `email`=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (password_verify($pass,$row['pass'])){
      $_SESSION["id"] = $row["id"];
      return "success";
    }else{
      return "error";
    }
  }
  static function changeUserData($userId,$item,$value){
    global $mysqli;
    if($item == "name")
      $stmt = $mysqli->prepare("UPDATE `users` SET `name`=? WHERE `id`=?");
    else if($item == "lastname")
      $stmt = $mysqli->prepare("UPDATE `users` SET `lastname`=? WHERE `id`=?");
    $stmt->bind_param("si",$value,$userId);
    $stmt->execute();
    return $stmt->error;
  }
  static function getUsers(){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM `users` WHERE 1");
    $data = $result->fetch_all( MYSQLI_ASSOC );
    return json_encode( $data );
    
  }
  static function getUser($userId){
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `id`=?");
    $stmt->bind_param("i",$userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return json_encode($row);
  }
}
?>