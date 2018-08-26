<?php

include("connections.php");

$user_id = $_GET["user_id"];

$get_record = mysqli_query($connections,"SELECT * FROM user WHERE user_id='$user_id'");

$get_record_num = mysqli_num_rows($get_record);

if($get_record_num > 0){
	
	while($row = mysqli_fetch_assoc($get_record)){
		
		$db_first_name = $row["first_name"];
		$db_middle_name = $row["middle_name"];
		$db_last_name = $row["last_name"];
		$db_gender = $row["gender"];
		$db_email = $row["email"];
	
	}
	
	$new_first_name = $new_middle_name = $new_last_name = $new_email = "";
	$new_first_nameErr = $new_middle_nameErr = $new_last_nameErr = $new_emailErr = "";
	
	if(isset($_POST["btnUpdate"])){
		
	if(empty($_POST["new_first_name"])){
		
		$new_first_nameErr = "This field must not empty.";
		
	}else{
		$new_first_name = $_POST["new_first_name"];
		$db_first_name = $new_first_name;
	}
	
	if(empty($_POST["new_middle_name"])){
		
		$new_middle_nameErr = "This field must not empty.";
		
	}else{
		$new_middle_name = $_POST["new_middle_name"];
		$db_middle_name = $new_middle_name;
	}
	
	if(empty($_POST["new_last_name"])){
		
		$new_last_nameErr = "This field must not empty.";
		
	}else{
		$new_last_name = $_POST["new_last_name"];
		$db_last_name = $new_last_name;
		
	}
	if(empty($_POST["new_email"])){
		
		$new_emailErr = "This field must not empty.";
		
	}else{
		$new_email = $_POST["new_email"];
		$db_email = $new_email;
		
	}	
		$new_gender = $_POST["new_gender"];
		
	if ($new_first_name && $new_middle_name && $new_last_name && $new_email){
		
	mysqli_query($connections,"UPDATE user SET 
	first_name = '$new_first_name',middle_name = '$new_middle_name', last_name = '$new_last_name', gender = '$new_gender', email = '$new_email'
	WHERE user_id = '$user_id'");	
	
	header("Location: index.php");
	}
	
		
}
	
?>
<style>
	.error {color: Red;}
</style>

	<form method ="POST">
		<input type ="text" name="new_first_name" value="<?php echo $db_first_name; ?>"> <span class = "error"> <?php echo $new_first_nameErr; ?></span> <br>
		
		<input type ="text" name="new_middle_name" value="<?php echo $db_middle_name; ?>"> <span class = "error"> <?php echo $new_middle_nameErr; ?></span> <br>
		
		<input type ="text" name="new_last_name" value="<?php echo $db_last_name; ?>"><span class = "error"> <?php echo $new_last_nameErr; ?> </span> <br>
		
		<select name ="new_gender">
		
			<option name="new_gender" <?php if($db_gender == "Male"){echo "selected";}?> value ="Male"> Male </option>
			
			<option name="new_gender" <?php if($db_gender == "Female"){echo "selected";}?> value ="Female"> Female </option>
			
		</select>
		<br>
		
		<input type ="text" name ="new_email" value=" <?php echo $db_email; ?> "><span class = "error"> <?php echo $new_emailErr; ?></span> <br>
		
		<input type="submit" name="btnUpdate" value="Update">
		&nbsp; 
		<a href = "index.php"> Cancel </a>
		
	</form>
		
<?php
}else{
		
		echo "<h1> No Record Found. </h>";
}
	

?>
