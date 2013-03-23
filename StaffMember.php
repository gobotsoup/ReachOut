<?php
require_once "MemberContactsDB.php";
$mysqli = getMemberContactsDB();
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";

$team = $_POST["team"];
$program = $_POST["program"];
$insert = "INSERT INTO StaffMember(Team, Program) VALUES('" . $team."', '" . $program."'" . ");";

$id = $mysqli->query($insert);
$query = "SELECT * FROM StaffMember";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

//echo $team . " " . $program . "id: " . $id . "<p>";
//echo $insert . "<p>";
// GOING THROUGH THE DATA
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {			
		echo $row['Team']  . ": " . $row["Program"] . "<br/>";
	}
}
else {
	echo 'NO RESULTS';	
}
	
// CLOSE CONNECTION
mysqli_close($mysqli);


?>
