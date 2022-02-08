<?php
        if(isset($_GET['errorArray'])){
               echo" <h2>Welcome  {$_COOKIE["fname"]}</h2>" ;
             $sudent = json_decode("",true);
        }
       

         if(isset($_GET['data'])){
            $sudent = json_decode($_GET['data'],true);
         }
?>




<html>

<body>
    <form method="get" action="studentController.php">
        <input type="hidden" value="<?= $sudent['id'] ?>" name="id">
        
        <input type="text" value="<?= $sudent['fname'] ?>" name="fname"><br>
        <input type="text" value="<?= $sudent['lname'] ?>" name="lname"><br>
        <input type="text" value="<?= $sudent['address'] ?>" name="address" id=""><br>
        <input type="email" value="<?= $sudent['email'] ?>" name="email" id=""><br>
        <input type="submit" value="update student" name="update">
    </form>
</body>

</html>