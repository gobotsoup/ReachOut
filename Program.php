<?php
require_once "MemberContactsDB.php";
$mysqli = getMemberContactsDB();
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";

$program = $_GET["program"];

$query = "SELECT * FROM StaffMember WHERE Program='" . $program ."'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

//echo $program . " " . $team . "id: " . $id . "<p>";
echo "<Title>" . $program . "</Title>";
// GOING THROUGH THE DATA
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {			
		echo "Program: " . $row['Program']  . "     Team: " . $row["Team"] . "<br/>";
	}
}
else {
	echo 'NO RESULTS';	
}
// CLOSE CONNECTION
mysqli_close($mysqli);
?>
<html>
	<head>
		<style type="text/css">
		</style>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
		<script type="application/javascript">
		
		// Read a page's GET URL variables and return them as an associative array.
		function getUrlVars(){    
			var vars = [], hash;    
			var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');    
			for(var i = 0; i < hashes.length; i++)    
			{        
				hash = hashes[i].split('=');        
				vars.push(hash[0]);        
				vars[hash[0]] = hash[1];    
			}    
			return vars;
		}
		function loadlist(selobj,nameattr)
		{
			var url = "getList.php?getlist=Locations";
			//url += "?getlist=Locations&where=" + getUrlVars()["program"];
    			$(selobj).empty();			

			$.getJSON(url,function(data) {
				
			  $.each(data, function(i,obj)
			  {				
			       $(selobj).append(
			   	 $('<option></option>').val(obj[nameattr]).html(obj[nameattr]));
			  });
			})
			//.success(function() { alert("second success"); })
			.error(function(data) { alert("error" + data); })
			.complete(function() { LocationChange(); });			
		}
		function LocationChange()
		{			
			$('.LocationInfo').empty();						

			$.getJSON("getList.php?getlist=Location&where=" + Location.value,function(data) {
				
			  $.each(data, function(i,obj)
			  {				
			       $('.LocationInfo').append("City:" + obj['City'] + "   Direct Hours:" + 
							 obj['Direct'] + "<br/>");
			  });
			})
			//.success(function() { alert("second success"); })
			.error(function(data) { alert("error" + data); })
			//.complete(function() { alert("complete"); });			
		}	
		</script>
	</head>
	<body onload="loadlist($('select#Location').get(0),/*the 'select' object*/ 			
 			'LocationName'/*The name of the field in the returned list*/
 			);"
		>
		Locations:<select name="Location" id="Location" onchange = "LocationChange()">
		</select>&nbsp; <button onclick="buttonClick()">Add Location Hours</button>
		<p><b>Location Info:</b>
		<div class="LocationInfo">		
		</div>
	</body>

</html>
