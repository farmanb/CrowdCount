<?php
	include 'generateSelect.php';
	include "/users/b/f/bfarman/dbInfo.php";

	$city = $_GET['city'];
	$state = $_GET['state'];
	$country = $_GET['country'];

	$conn = mysql_connect(dbString, dbUser, dbPass);

	mysql_select_db(dbName);

	$query = "SELECT c.Date, count(*) from CrowdCount as c " .
		"INNER JOIN Locations as l " .
		"on c.LocationID = l.ID " .
		"where l.City='$city' AND l.State='$state' AND l.Country='$country' " .
		"group by c.Date";
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
