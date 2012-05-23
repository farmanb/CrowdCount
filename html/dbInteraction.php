  <?php 
    $city = $_GET['city'];
    $state = $_GET['state'];
    $country = $_GET['country'];
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];

     include "/users/b/f/bfarman/dbInfo.php";
     $conn = mysql_connect(dbString, dbUser, dbPass);

     mysql_select_db(dbName);
     
     $locIDQuery = "SELECT ID FROM Locations WHERE " .
     		 "City= '" . $city . "' AND " . 
     		 "State = '" . $state . "' AND " . 
		 "Country = '" . $country . "' AND ".
		 "Latitude = '" . $latitude . "' AND ".
		 "Longitude = '" . $longitude . "'";
     $result = mysql_query($locIDQuery);

     $locID = -1;
     
     /*Insert the location if it doesn't already exist.*/
     if(mysql_num_rows($result) == 0){
     	 if (!mysql_query("INSERT INTO Locations (City,State,Country, Latitude, Longitude) VALUES ('$city','$state','$country', '$latitude', '$longitude')")){
	     echo "Error adding location.";
	 }
	 $result = mysql_query("SELECT LAST_INSERT_ID() FROM Locations");
	 $locID = mysql_fetch_array($result);
     }
     else{
	 $locID = mysql_fetch_array($result);
     }
     $locID = $locID[0];

     /*Set the timezone*/
     date_default_timezone_set('America/New_York');
     
     /*Record the date and the location*/
     $query = "INSERT INTO CrowdCount (LocationID, Date, Time) VALUES ('$locID', '" . date("Y-m-d") . "','" . date("g:i:s:u") ."')";
     mysql_query($query);
     
     mysql_close($conn);
     echo "$locID";
?>
