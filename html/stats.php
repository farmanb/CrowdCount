<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  
"http://www.w3.org/TR/xhtml11/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>
    Stats
    </title>
    <script src="https://www.google.com/jsapi?key=ABQIAAAA7t2ISUFvNpKam51yH5J1NRTug3FjRBdPteh6E-oE1d6ZZp9bMxRgGpaC2dF1zrNdj9g-HV0pM41Gow" type="text/javascript"></script>
    
    <script language="Javascript" type="text/javascript">
        google.load("jquery", "1");
	var country, state, city;
	function genState(){
		country = $("#countrySelect").val();
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4){
				$("#statePlaceholder").html(xmlhttp.responseText);
			}
		}
		xmlhttp.open("GET", "genState.php?country=" + country, true);
	    	xmlhttp.send();
	}

	function genCity(){
		state = $("#stateSelect").val();
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4){
				$("#cityPlaceholder").html(xmlhttp.responseText);
			}
		}
		xmlhttp.open("GET", "genCity.php?country=" + country + "?state=" + state, true);
	   	xmlhttp.send();
	}
	function getCount(){
		city = $("#citySelect").val();
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4){
				$("#results").html(xmlhttp.responseText);
			}
		}
		xmlhttp.open("GET", "getCount.php?city=" + city + "?state=" + state + "?country=" + country, true);
	   	xmlhttp.send();
	}
    </script>
    </head>
    <body>
    <p>
	<form>	
	    <?php	
	include 'generateSelect.php';
	include "/users/b/f/bfarman/dbInfo.php";
        
	$conn = mysql_connect(dbString, dbUser, dbPass);

	mysql_select_db(dbName);

	$countryQuery = "SELECT Code,Name FROM CountryCodes";
	$result = mysql_query($countryQuery) or die('Invalid query: ' . mysql_error());

	$retVal = array();
	$retVal["Select Your Country"] = "--";

	if (mysql_num_rows($result) != 0){
		while ($row = mysql_fetch_assoc($result)){
			$retVal[$row['Name']] = $row['Code'];
		}
	}
	
	echo generateSelect($name = 'countrySelect', $retVal, 'genState()');
	?>	
    </p>
    <p>
    <span id="statePlaceholder"></span>
    </p>
    <p>
    <span id="cityPlaceholder"></span>
    </p>
    <p>
    <span id="results"></span>
    </p>
	</form>
    </body>
    </html>