<html>
    <body>
        <?php 
        
    require("db.php");
    $db=new db();
    $connection=$db->get_connection();

        if($_COOKIE["fname"]){
               echo" <h2>Welcome  {$_COOKIE["fname"]}</h2>" ;
        }
         else{
             header("location:login.php");
         }
        
        ?>  




        <a href="addStudent.php">Add Student</a>
        <table border=1>
            <tr>
                <th>id</th>
                <th>fname</th>
                <th>lname</th>
                <th>email</th>
                <th>address</th>
            </tr>
  


<?php

try{

  $data =$db->show("*","student");
while($row=$data->fetch(PDO::FETCH_ASSOC)){
    echo "<tr>";
 foreach($row as $key => $val ){
     if($key!= "password"){
     echo "<td> $val </td>";
 }
}
echo "<td><a href='studentController.php?id={$row['id']}&show'>show</a></td>";
echo "<td><a href='studentController.php?id={$row['id']}&edit'>edit</a></td>";
echo "<td><a href='studentController.php?id={$row['id']}&delete'>delete</a></td>";
    echo  "</tr>";
}


}catch(PDOException $e){
echo $e;
}

$connection = null;
?>


      </table>
    </body>
</html>