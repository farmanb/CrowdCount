  <?php 
     $args = $_GET['city'];
     $location = preg_split('/\?/', $args);
     $location[1] = preg_replace("/.*=/", "", $location[1]);
     $location[2] = preg_replace("/.*=/", "", $location[2]);
     $city = $location[0];
     $state = $location[1];
     $country = $location[2];
     
     echo "$location[0], $location[1], $location[2]";
     
     include "/home/blake/dbInfo.php";
     $conn = mysql_connect(dbString, dbUser, dbPass);

     mysql_select_db(dbName);
     
     $locIDQuery = "SELECT ID FROM Locations WHERE City= '" . $city . "' AND State = '" . $state . "'" . "AND Country = '" . $country . "'";
     $result = mysql_query($locIDQuery);
     
     $locID = -1;
     
     /*Insert the location if it doesn't already exist.*/
     if(mysql_num_rows($result) == 0){
	 if (!mysql_query("INSERT INTO Locations (City,State,Country) VALUES ('$city','$state','$country')")){
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
     $query = "INSERT INTO CrowdCount (LocationID, Date, Time) VALUES ('$locID', '" . date("Y-m-d") . "','" . date("g:m:s:u") ."')";
     mysql_query($query);
     
     mysql_close($conn);
?>
