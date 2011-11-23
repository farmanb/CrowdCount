<?php
	include 'generateSelect.php';
	include "/users/b/f/bfarman/dbInfo.php";

	$args = $_GET['city'];
	$location = preg_split('/\?/', $args);
	$city = $location[0];
	$state = preg_replace("/.*=/", "", $location[1]);
	$country = preg_replace("/.*=/", "", $location[2]);

	$conn = mysql_connect(dbString, dbUser, dbPass);

	mysql_select_db(dbName);

	$locIDQuery = "SELECT ID FROM Locations WHERE City= '" . $city . "' AND State = '" . $state . "'" . "AND Country = '" . $country . "'";
	$result = mysql_query($locIDQuery) or die('Invalid query: ' . mysql_error());
	
	$row = mysql_fetch_assoc($result);
	$locID = $row['ID'];

	$query = "select Date, count(*) from CrowdCount where LocationID='"  . $locID. "' group by Date";
	$result = mysql_query($query) or die('Invalid query: ' . mysql_error());

	$html = "<table cellpadding=\"10\">\n";
	$html .= "<tr>\n";
	$html .= "<td>\n";
	$html .= "Date\n";
	$html .= "</td>\n";
	$html .= "<td>\n";
	$html .= "Count\n";
	$html .= "</td>\n";
	
	while ($row = mysql_fetch_assoc($result)){
		$html .= "<tr>\n";
		$html .= "<td>\n";
		$html .= $row['Date'] . "\n";
		$html .= "</td>\n";
		$html .= "<td>\n";
		$html .= $row['count(*)'] . "\n";
		$html .= "</td>\n";
	}	
	$html .= "</table>\n";
	echo $html;
?>