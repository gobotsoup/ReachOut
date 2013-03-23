<?php

$host="localhost"; 
$username="briank";
$password="st0r3dFluff";
$db_name="MemberContacts";
//phpinfo();

$mysqli = new mysqli($host, $username, $password, $db_name);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

$Sname = $_POST["serviceName"];
$Sdesc = $_POST["serviceDesc"];
$insert = "INSERT INTO Service(ServiceType, ServiceDescription, idLocationHours) VALUES('" . $Sname."', '" . $Sdesc."', " .  "1);";

$id = $mysqli->query($insert);
// A QUICK QUERY ON A FAKE USER TABLE
$query = "SELECT * FROM Service";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

//echo $Sname . " " . $Sdesc . "id: " . $id . "<p>";
//echo $insert . "<p>";
// GOING THROUGH THE DATA
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {			
		echo $row['ServiceDescription']  . ": " . $row["ServiceType"] . "<br/>";
	}
}
else {
	echo 'NO RESULTS';	
}
	
// CLOSE CONNECTION
mysqli_close($mysqli);


?>


