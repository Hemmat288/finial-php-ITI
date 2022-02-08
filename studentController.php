<?php
require("db.php");
  $db=new db();
  $connection=$db->get_connection();
 

////////////////addstudent

if(isset($_POST['addstudent'])){

try{
 
 $fname=validation($_POST['fname']);
 $lname=validation($_POST['lname']);
 $email=validation($_POST['email']);
 $address=validation($_POST['address']);
 $Password=validation($_POST['Password']);
   $imgName=validation($_FILES["img"]["name"]);

  $error=[];


 
 if(strlen($fname)<3){
       $error["fname"] = "first name must be more than 3 char";
 }

 if(strlen($lname)<3){
  $error["lname"] = "last name must be more than 3 char";
 }
 
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $error["email"] = "pls enter valid email";
}
 
if(count($error)>0){
       $errorArray = json_encode($error);
      header("location:addStudent.php?error=$errorArray");
}

 $imgExtension= pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION);
 
 $allowedExtension=["png","jpg","txt"];

 if(!in_array($imgExtension,$allowedExtension)){
   $error["imgExtension"]="not in allow imgExtension";

     header("location:addStudent.php?error=$imgExtension");
 }
 
  if(!move_uploaded_file(
    $_FILES["img"]["tmp_name"],
    $_FILES["img"]["name"])){
      $error["img"]="img is not exists";
    }

 else {
   $db->insert("student","
       fname = '$fname',
        lname='$lname', 
        email='$email',
         address='$address',
         password='$password',
         imgName='$imgName'"
);    
      header("location:list.php");
    }
}catch(PDOException $e){
echo $e;
}

$connection = null;
 

}


////////////delete

else if(isset($_GET['delete'])){
 $id=$_GET['id'];
 
try{
 

 $db->delete("student","id=$id");
  header("location:list.php");

}catch(PDOException $e){
echo $e;
}
$connection = null;
}

/////////////////show

else if(isset($_GET['show'])){
$id=$_GET['id'];
try {  
  $sudentData=$db->select("*","student","id=$id");
  $studentinfo=$sudentData->fetch(PDO::FETCH_ASSOC);
   $data=json_encode($studentinfo);
   header("location:show.php?data=$data");
}catch(PDOException $e){
 
  }
  $connection = null;
}

// /////////////////edit

else if(isset($_GET['edit'])){
$id=$_GET['id'];
try {  
 $sudentData=$db->select("*","student","id=$id");
 
  $studentinfo=$sudentData->fetch(PDO::FETCH_ASSOC);
   $data=json_encode($studentinfo);
   header("location:edit.php?data=$data");
}catch(PDOException $e){
 echo $e;
  }
  $connection = null;
}


// //////////////update

else if (isset($_GET['update'])){
try{
  $id=validation($_GET['id']);
 $fname=validation($_GET['fname']);
 $lname=validation($_GET['lname']);
 $email=validation($_GET['email']);
 $address=validation($_GET['address']);
  $error=[];
 if(strlen($fname)<3){
       $error["fname"] = "first name must be more than 3 char";
 }

 if(strlen($lname)<3){
  $error["lname"] = "last name must be more than 3 char";
 }
 
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $error["email"] = "pls enter valid email";
}
 
if(count($error)>0){
  
       $errorArray = json_encode($error);
 
  header("location:edit.php?errorArray=$errorArray&id='$id'");
}
else{
  $sudentData=$db->update("student","
  fname='$fname',
     lname='$lname',
     email='$email',
     address='$address'
  ","id= $id");
     header("location:list.php");
}
}catch(PDOException $e){
echo $e;
}
}

// ////////////////////login
else if(isset($_POST['login'])){

    
 $sudentData=$db->select( "*" ,"student" ,"email='{$_POST['email']}' and password='{$_POST['Password']}'");
$studentinfo=$sudentData->fetch(PDO::FETCH_ASSOC);
   $email=$studentinfo["email"];
  $password=$studentinfo["password"];
  //////////////// $ sudentData check not work with me
    if($password!="" && $email!=""){
     
    header("location:list.php");
  }else{
    header("location:login.php");
  }
  
  
   
}



/////////////////validation
function validation($data){
  //// delete  html code - // - space 
  $data = htmlspecialchars(stripcslashes(trim($data)));
  return $data;
}
 ?>