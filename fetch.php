 <?php  
//Database 
require "config.php"; 

 $output = array();  
 $query = "SELECT * FROM student";  
 $result = mysqli_query($link, $query);  
   
      while($row = mysqli_fetch_array($result))  
      {  
           $output[] = $row;  
      }  
      echo json_encode($output);  
  
 ?>