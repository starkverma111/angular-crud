<?php
//Database 
require "config.php"; 

$data = json_decode(file_get_contents("php://input"));


$name = mysqli_real_escape_string($link, $data->name);
$city = mysqli_real_escape_string($link, $data->city);
	if($name!="" && $city!="" ){
				$sql="INSERT INTO student (name, city)VALUES ('$name', '$city')";
				$datc= mysqli_query($link,$sql);
					if($datc){
						echo "Data Inserted";
					}
						else{
							echo "eror";
						}
				
				} 
	else{
				echo "all fields required !";
			}
mysqli_close($link);
?>  