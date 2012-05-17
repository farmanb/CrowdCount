<?php
	include 'generateSelect.php';
	#include "/users/b/f/bfarman/dbInfo.php";
	include "/Users/blake/dbinfo.php";
        
	$conn = mysql_connect(dbString, dbUser, dbPass);

	mysql_select_db(dbName);

	$countryQuery = "SELECT Code,Name FROM CountryCodes";
	$result = mysql_query($countryQuery) or die('Invalid query: ' . mysql_error());

	$retVal = array();

	if (mysql_num_rows($result) != 0){
		while ($row = mysql_fetch_assoc($result)){
			$retVal[$row['Name']] = $row['Code'];
		}
	}
	
	echo generateSelect($name = 'countrySelect', $retVal);

?>