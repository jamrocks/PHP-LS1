<?php

include("navigation.php");

$drinks = $drinksErr = "";

	if(isset($_POST["btnSubmit"])){
		
		if(empty($_POST["drinks"])){
		
			$drinksErr = "Please select at least one (1) drink ";
			
		}else{
		
			$drinks = $_POST["drinks"];
		}
		
	}

?>
<style> 
.error {
	color:red;
}
</style>


<form method = "POST"> 
	<input type ="checkbox" name="drinks[]" value="fruit soda"> Fruit Soda <br>
	<input type ="checkbox" name="drinks[]" value="Tang Orange"> Tang Orange <br>
	<input type ="checkbox" name="drinks[]" value="Eight oclock"> Eight O'clock<br>
	<input type ="checkbox" name="drinks[]" value="Cool Aid"> Cool Aid <br>
	<input type ="checkbox" name="drinks[]" value="Mountain Dew"> Mountain Dew <br>
	<input type ="checkbox" name="drinks[]" value="Coke"> Coke<br>
	<input type ="checkbox" name="drinks[]" value="Sparkle"> Sparkle <br>
	<input type ="checkbox" name="drinks[]" value="Pepsi"> Pepsi<br>
	
	<input type="submit" name="btnSubmit" value="Submit"> 
</form>

<br>
<span class ="error"> <?php echo $drinksErr; ?> </span>
<hr>

<?php

	
   if($drinks){
		
		foreach($drinks as $new_drinks){
			
			echo $new_drinks . "<br>";
				
				//mysqli_query($connections, "INSERT INTO user(db_drinks) VALUES ($new_drinks)"
			}
		
	}

	

?>













