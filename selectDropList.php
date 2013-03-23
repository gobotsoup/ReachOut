


<?php
		$host="localhost"; 
		$username="briank";
		$password="st0r3dFluff";
		$db_name="MemberContacts";
		$mysqli = new mysqli($host, $username, $password, $db_name);
		if ($mysqli->connect_errno) {
    			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}		
		$query = "SELECT * FROM StaffMember";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

		
		if($result->num_rows > 0) {
			echo "<select>";
			
			while($row = $result->fetch_assoc()) {			
				echo "<option value=\"" . $row['Team'] . "\">" . $row["Program"] . "</option>";
			}
			echo "</select>";
		}
		else {
			echo 'NO RESULTS';	
		}		

?>
