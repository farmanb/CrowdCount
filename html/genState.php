<?php
	include 'generateSelect.php';
	include "/users/b/f/bfarman/dbInfo.php";

	$country = $_GET['country'];
        
	$conn = mysql_connect(dbString, dbUser, dbPass);

	mysql_select_db(dbName);

	$countryQuery = "SELECT Code,Name FROM StateCodes WHERE CountryCode='" . $country . "'";
	$result = mysql_query($countryQuery) or die('Invalid query: ' . mysql_error());

	$retVal = array();
	$retVal["Select Your State"] = "--";
	
	if (mysql_num_rows($result) != 0){
		while ($row = mysql_fetch_assoc($result)){
			$retVal[$row['Name']] = $row['Code'];
		}
	}
	
	echo generateSelect($name = 'stateSelect', $retVal, 'genCity()');

?>