<?php
    



function getMemberContactsDB()
{
	$host="localhost"; 
	$username="briank";
	$password="st0r3dFluff";
	$db_name="MemberContacts";
	$mysqli = new mysqli($host, $username, $password, $db_name);
	return $mysqli;
}

?>
