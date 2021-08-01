<?php  
 //delete.php  
 require "config.php";
 $data = json_decode(file_get_contents("php://input")); 
 
 $connect = mysqli_connect("localhost", "root", "", "pemo");  
    
      $id = $data->id;  
      $query = "DELETE FROM student WHERE id='$id'";  
      if(mysqli_query($connect, $query))  
      {  
           echo 'Data Deleted';  
      }  
      else  
      {  
           echo 'Error';  
      }    
 ?>  