<?php

include("connections.php");

$user_id = $_GET["user_id"];

$get_record = mysqli_query($connections,"SELECT * FROM  user WHERE user_id='$user_id'");

$check_get_record = mysqli_num_rows($get_record);

if($check_get_record > 0 ){
	
	$row = mysqli_fetch_assoc($get_record);
	
	$db_first_name = $row["first_name"];
	$db_middle_name = $row["middle_name"];
	$db_last_name = $row["last_name"];
	
	$full_name = ucfirst($db_first_name) . " " . ucfirst($db_middle_name[0]) . " " . ucfirst($db_last_name);
	
	if(isset($_POST["btnDelete"])){
		
		mysqli_query($connections, "DELETE FROM user WHERE user_id='$user_id'");
		
		header("Location: index.php");
		
	}
	
?>
<form method = "POST">

	<h1> You are about to delete a record in the database.<font color ="red"> <?php echo $full_name ?></font> </h1>	<br>
	
	<h3>Are you sure you want to delete record? </h3> <br>
	
	<input type="submit" name="btnDelete" value="Delete">
	&nbsp;
	<a href = "index.php" > Cancel </a>
	

<?php

	echo "";

}else{

	echo "<h1> No Record Found </h>";
}

?>