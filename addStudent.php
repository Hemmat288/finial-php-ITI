
<?php
 

if(isset($_REQUEST['errorArray'])){
  $error=json_decode(($_REQUEST['errorArray']),true);
 
 }

       if($_COOKIE["fname"]){
               echo" <h2>Welcome  {$_COOKIE["fname"]}</h2>" ;
        }
         else{
             header("location:login.php");
         }
?>
<html>
 <body>
     <form method="post" action="studentController.php" enctype="multipart/form-data">
   
         <input required type="text" name="fname" placeholder="First Name">
         <?php if(isset($error["fname"])){
           echo $error["fname"];
         } ?>
         <br>
         <input required type="text" name="lname" placeholder="last Name" >
         <?php if(isset($error["lname"])){
           echo $error["lname"];
         } ?>
         
         <br>
         <input required type="mail" name="email" placeholder="Email">
         <?php if(isset($error["email"])){
           echo $error["email"];
         } ?>
         <br>
         <input  type="text" name="address" placeholder="Address">
         <br>
          
        <input type="password" name="Password" placeholder="passwoord...">
        <br>
       <input type="file" name="img" placeholder="Upload File">
       <br>
         <br>
        <input type="submit" value="Add student" name="addstudent">
        
            </form>
</body>
</html>