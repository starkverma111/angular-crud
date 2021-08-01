
<?php
require "config.php"; 

$data = json_decode(file_get_contents("php://input"));

$id = mysqli_real_escape_string($link, $data->u_id);
$name = mysqli_real_escape_string($link, $data->u_name);
$city = mysqli_real_escape_string($link, $data->u_city);

if($id!="" && $name!="" && $city!="" ){
$sql="UPDATE `student` SET `name`='$name',`city`= '$city' WHERE id = '$id'"; 
	$datc= mysqli_query($link,$sql);
		if($datc){
			echo "Data Updated";
		}
		else{
			echo "error";
		}
}else{
	echo "all fields required !";
}	
mysqli_close($link);
 
?>  