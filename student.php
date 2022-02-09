<?php

class student{
private $id;
private $fname;
private $lname;
private $email;
private $address;
private $password;
private $imgName;
private $error=[];
public function __construct(){

}
public function __set($key, $value)
{
   if($key ==="fname"){
      if(strlen($value)>3){
          $this->$key=$value;
      }
      else{
        $this->error["fname"] = "first name must be more than 3 char";
      }
 }
 else if($key=== "lname"){
        if(strlen($value)>3){
        $this->$key=$value;
        }
        else{
          $this->error["lname"] = "last name must be more than 3 char";
        }
}
 else if($key==="email"){
        if(!filter_var($key, FILTER_VALIDATE_EMAIL)){
            $this->$key=$value;
        } else{
               $this->error["email"] = "pls enter valid email";
        }
  }
  else{
      $this->$key=$value;
      
  }
}
 
function __get($name)
{
 return $this->$name;
}
 
/////////////////validation
function validation($data){
  $data = htmlspecialchars(stripcslashes(trim($data)));
  return $data;
}

function countError(){
 return count($this->error);
 
}
}



?>