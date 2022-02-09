<?php
require("db.php");
require("student.php");
  $db=new db();
  $connection=$db->get_connection();
 $student=new student();

////////////////addstudent

if(isset($_POST['addstudent'])){

try{
 
$student->fname=$student->validation($_POST['fname']);
$student->lname=$student->validation($_POST['lname']);
$student->address=$student->validation($_POST['address']);
$student->email=$student->validation($_POST['email']);
$student->Password=$student->validation($_POST['Password']);
$student->imgName=$student->validation($_FILES["img"]["name"]);
  $error=$student->countError();
 


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
if($error>0){
       $errorArray = json_encode($student->error);
      header("location:addStudent.php?errorArray=$errorArray");
}
 else {
 $fname= $student->fname;
 $lname=$student->lname;
$address=$student->address;
$email=$student->email;
$password=$student->password;
$imgName=$student->imgName;


   $db->insert("student","
       fname ='$fname',
        lname='$lname', 
        email='$email',
         address='$address',
         password='$password',
         imgName='$imgName'"
);    
     header("location:list.php?fname?$fname");
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
  
 $student->id=$student->validation($_GET['id']);
 $student->fname=$student->validation($_GET['fname']);
$student->lname=$student->validation($_GET['lname']);
$student->address=$student->validation($_GET['address']);
$student->email=$student->validation($_GET['email']);
$student->Password=$student->validation($_GET['Password']);
$student->imgName=$student->validation($_FILES["img"]["name"]);
  $error=$student->countError();
 
 
if( $error>0){
  
       $errorArray = json_encode($student->error);
 
  header("location:edit.php?errorArray=$errorArray&id='$id'");
}
else{
  $id= $student->id;
$fname= $student->fname;
$lname=$student->lname;
$address=$student->address;
$email=$student->email;
$password=$student->password;
$imgName=$student->imgName;
  $sudentData=$db->update("student","
  fname='$fname',
     lname='$lname',
     email='$email',
     address='$address'
  ","id= $id");
  
     header("location:list.php?length=$er");
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
    if($password!="" && $email!=""){
       setcookie("fname",$studentinfo["fname"]);
    header("location:list.php");
  }else{
    header("location:login.php");
  }
  
  
   
}




 ?>
