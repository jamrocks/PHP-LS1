<?php

include ("connections.php");
include("navigation.php");


	if (empty($_GET ["search"])){
		echo "Index must not be empty";
	}else{
		
		$search = $_GET["search"];
		
		$terms = explode(" ", $search);
		
		$query = "SELECT * FROM user WHERE ";
		
		$i = 0;
		
		foreach ($terms as $each){
		
			$i++;
			
			if ($i == 1){
				$query .= " first_name LIKE '%$each%'";
			}else{
				$query .= " OR first_name LIKE '%$each%'";
			}
		}
		
		$query_2 = mysqli_query($connections, $query);
		
		$check_dbrows = mysqli_num_rows($query_2);
		
		if ($check_dbrows >0 && $search != " "){
			while($row = mysqli_fetch_array($query_2)){
				
				$user_id = $row["user_id"];
				$db_first_name = $row["first_name"];
				$db_middle_name = $row["middle_name"];
				$db_last_name = $row["last_name"];
				
				$full_name = ucfirst($db_first_name). " " . ucfirst($db_middle_name[0]). "." . ucfirst($db_last_name);
				
				echo "$full_name 
					<a href ='edit.php?user_id=$user_id'> Update </a> 
					|
					<a href ='delete.php?user_id=$user_id'> Delete </a> <br><hr>";
			
			}
			
		}else{
			echo "<h1>No results found</h1>";
		}
	}
	
	
		

?>