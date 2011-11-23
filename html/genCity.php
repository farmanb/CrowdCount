<?php
	include 'generateSelect.php';
	include "/users/b/f/bfarman/dbInfo.php";

	$args = $_GET['country'];
	$location = preg_split('/\?/', $args);
	$country = $location[0];
	$state =  preg_replace("/state=/", "", $location[1]);
        
	$conn = mysql_connect(dbString, dbUser, dbPass);

	mysql_select_db(dbName);

	$countryQuery = "SELECT City FROM Locations WHERE Country='" . $country . "' and State = '" . $state . "'";
	$result = mysql_query($countryQuery) or die('Invalid query: ' . mysql_error());

	$retVal = array();
	$retVal["Select Your State"] = "--";
	
	if (mysql_num_rows($result) != 0){
		while ($row = mysql_fetch_assoc($result)){
			$retVal[$row['City']] = $row['City'];
		}
	}

	echo generateSelect($name = 'citySelect', $retVal, 'getCount()');

?>