<?php

class student{
private $id;
private $fname;
private $lname;
private $email;
private $address;
private $password;
private $imgName;

public function __construct(){

}
public function __set($key, $value)
{
    if($key=='fname'){
  if(strlen($key)<3){
      $this->fname=$value;
  }
 }
 if($key=='lname'){
 if(strlen($key)<3){
     $this->lname=$value;
 }
}
  if($key=='email'){
if(!filter_var($key, FILTER_VALIDATE_EMAIL)){
    $this->email=$value;
} 
  }
  else{
      $this->$key=$value;
  }
}

}



?>