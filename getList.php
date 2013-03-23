<?php

require_once "json-util.php";
    
$host="localhost"; 
$username="briank";
$password="st0r3dFluff";
$db_name="MemberContacts";
$mysqli = new mysqli($host, $username, $password, $db_name);


if(!empty($_GET['getlist']))
{
    $list = $_GET['getlist'];
    
    $qry='';
    switch($list)
    {
        case 'Program':
        {
            $qry = "SELECT Program FROM StaffMember";
            break;
        }
		case 'ProgramMembers':
		{
			$where =  $_GET['where'];
			$qry = "SELECT * FROM StaffMember WHERE Program = '" . $where . "'";
    		break;
		}
		case 'Locations':
		{			
			$qry = "SELECT LocationName FROM Location";			
			break;
		}
		case 'Location':
		{
			$where = $_GET['where'];
			$qry = "SELECT * FROM Location l JOIN MemberContacts.LocationHours lh ON l.idLocationHours = 					lh.idLocationHours AND l.LocationName =  '" . $where . "'
				JOIN MemberContacts.TotalHours h ON lh.idTotalHours = h.idTotalHours";
			break;

			/*
				SELECT * FROM MemberContacts.Location l 
				JOIN MemberContacts.LocationHours lh ON l.idLocationHours = lh.idLocationHours AND 					l.LocationName = 'Holiday Inn'
				JOIN MemberContacts.TotalHours h ON lh.idTotalHours = h.idTotalHours

			*/
		}
    }
    
    // btw sending a table would be bad thing to do security wise...
    if(empty($qry)){ echo "invalid params! "; exit; }

    if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }     
    
     
    $result = $mysqli->query($qry) or die($mysqli->error.__LINE__);
     
    $rows = array();
         
    while($rec = $result->fetch_assoc()) 
    {
        $rows[] = $rec;
    }
    $result->close();
    
    $json = json_encode($rows);
    
    error_log($json,0);
    echo $json;
}
$mysqli->close();
?>
