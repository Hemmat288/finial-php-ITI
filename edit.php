<?php
   
            if(isset($_REQUEST['errorArray'])){
               echo" <h2>Welcome  {$_COOKIE["fname"]}</h2>" ;
             $sudent = json_decode("",true);
             $error=json_decode(($_REQUEST['errorArray']),true);
 
 }

         if(isset($_GET['data'])){
                echo" <h2>Welcome  {$_COOKIE["fname"]}</h2>" ;
            $sudent = json_decode($_GET['data'],true);
         }
?>




<html>

<body>
    <form method="get" action="studentController.php">
        <input type="hidden" value="<?= $sudent['id'] ?>" name="id">
        
        <input type="text" value="<?= $sudent['fname'] ?>" name="fname">
             <?php if(isset($error["fname"])){
           echo $error["fname"];
         } ?>
        <br>
        <input type="text" value="<?= $sudent['lname'] ?>" name="lname">
              <?php if(isset($error["lname"])){
           echo $error["lname"];
         } ?>
        <br>
        <input type="text" value="<?= $sudent['address'] ?>" name="address" id="">
             <?php if(isset($error["email"])){
           echo $error["email"];
         } ?>
        <br>
        <input type="email" value="<?= $sudent['email'] ?>" name="email" id=""><br>
        <input type="submit" value="update student" name="update">
    </form>
</body>

</html>