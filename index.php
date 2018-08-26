<?php

include("connections.php");

$first_name = $middle_name = $last_name = $email = $gender = "";
$first_nameErr = $middle_nameErr = $last_nameErr = $emailErr = $genderErr = "";

if (isset($_POST["btnRegister"])){
	
	if(empty($_POST["first_name"])){
		$first_nameErr = "First Name is required.";
	}else{
		$first_name = $_POST["first_name"];
	}
	
	if(empty($_POST["middle_name"])){
		$middle_nameErr = "Middle Name is required.";
	}else{
		$middle_name = $_POST["middle_name"];
	}
	
	
	if(empty($_POST["last_name"])){
		$last_nameErr = "Last Name is required.";
	}else{
		$last_name = $_POST["last_name"];
	}
	
	if(empty($_POST["email"])){
		$emailErr = "E-mail is required.";
	}else{
		$email = $_POST["email"];
	}
	
	
	if(empty($_POST["gender"])){
		$genderErr = "Gender is required.";
	}else{
		$gender = $_POST["gender"];
	}
	
	if($first_name && $middle_name && $last_name && $gender && $email){
		
		$check_firstname = strlen($first_name);
			
			if($check_firstname <2){
				
				$first_nameErr = "First name is too short.";
			}else{
				$check_middlename = strlen($middle_name);
					
					if($check_middlename < 2) {
						$middle_nameErr = "Middle name is too short.";
					}else{
						
						$check_lastname = strlen($last_name);
						
							if ($check_lastname <2){
								$last_nameErr = "Last name is too short.";
							}else{
								
								if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
									$emailErr = "Invalid E-mail format.";
								}else {
									
									mysqli_query($connections, "INSERT INTO user(first_name,middle_name,last_name,gender,email) 
									VALUES ('$first_name','$middle_name','$last_name', '$gender','$email')");
									
									header("Location: index.php");
									
								}
							}
					}
			}
		
		
	}
	
}

?>

<style>

.error {color:Red;}

 </style>


<form method="POST">

<input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>"> <span class="error"><?php echo $first_nameErr; ?></span> <br>

<input type="text" name="middle_name" placeholder="Middle Name" value="<?php echo $middle_name; ?>"> <span class="error"><?php echo $middle_nameErr; ?></span><br>

<input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>"> <span class="error"><?php echo $last_nameErr; ?></span> <br>

<input type="text" name="email" placeholder="E-mail" value="<?php echo $email; ?>"> <span class="error"><?php echo $emailErr; ?></span><br>

<select name="gender">

	<option name ="gender" value=""> Select Gender </option>
	
	<option name ="gender" <?php if($gender == "Male"){echo "selected";} ?> value="Male"> Male </option>
	
	<option name ="gender" <?php if($gender == "Female"){echo "selected";} ?> value="Female"> Female </option>
	
</select>
<span class="error"><?php echo $genderErr; ?></span>
<br><br>

<input type="Submit" name="btnRegister" value="Register"> <br>

</form>

<hr>
<center>

<?php 

$search = $searchErr = "";

	if(isset($_POST["btnSearch"])){
		if(empty($_POST["search"])){
			$searchErr ="Field must not be empty.";
		}else{
			
			$search = $_POST["search"];
		}
	}


?>


<table border="0" width="50%"> 
	
	<form method ="POST">
		<tr>
			<td colspan ="2"> </td>
			<td> <div align="right"> <input type="text" name="search" value="" placeholder="Type Name or Lastname"><br><span class ="error"> <?php echo $searchErr; ?> </span></td>
			<td> <div align="right"> <input type="submit" name="btnSearch" value="Search"></td>
			<td> </td>
		</tr>
	</form>
	
	<tr> 
		<td colspan ="4"> <hr> </td>
	</tr>
	
	<tr>
		<td> <b> Name </b> </td>
		<td> <b> Gender </b> </td>
		<td> <b> E-mail </b> </td>
		<td> <center><b> Option</b></center></td>
		
	</tr>
	
	<tr> 
		<td colspan ="4"> <hr> </td>
	</tr>
	
	<?php
		
		$full_name = "";
		
		
		$view_query = mysqli_query($connections,"SELECT * FROM user");
			while($row = mysqli_fetch_assoc($view_query)){
				$user_id = $row ["user_id"];
				
				$db_first_name = $row["first_name"];
				$db_middle_name = $row["middle_name"];
				$db_last_name = $row["last_name"];
				$db_gender = $row["gender"];
				$db_email = $row["email"];
				
				$full_name = ucfirst($db_first_name). " " . ucfirst($db_middle_name[0]). "." . ucfirst($db_last_name);
				
				echo "
					<tr>
						<td>$full_name</td>
						<td>$db_gender</td>
						<td>$db_email</td>
						<td>
							<center> <a href ='edit.php?user_id=$user_id'> Update </a> 
							|
							<a href ='delete.php?user_id=$user_id'> Delete </a></center>
						</td>
					</tr>
					
					<tr>
						<td colspan ='4'><hr></td>
					</tr>
				";
			}
		
	?>
	
</table>
</center>