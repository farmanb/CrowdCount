google.load("jquery", "1");
google.load("maps", "3", {other_params: "sensor=false"});

var city, state, country, latitude, longitude;

function count(){
    var xmlhttp = new XMLHttpRequest();
    $("#status").html("Sending...");
    
    xmlhttp.onreadystatechange = function(){
	if (xmlhttp.readyState == 4){
	    $("#status").html("Counted.");
	}
    }
    
    xmlhttp.open("GET", "dbInteraction.php?city=" + city + "&state=" + state + "&country=" + country + "&latitude=" + latitude + "&longitude=" + longitude, true);
    xmlhttp.send();

    displayCount();
}

function displayCount(){
    var countReq = new XMLHttpRequest();
    
    countReq.onreadystatechange = function(){
	if (countReq.readyState == 4){
	    $("#countPlaceholder").html(countReq.responseText);
	}
    }

    countReq.open("GET", "getCount.php?city=" + city + "&state=" + state + "&country=" + country, true);
    countReq.send();
}

google.setOnLoadCallback(function() {
    var geocoder = new google.maps.Geocoder();
    if (navigator.geolocation){
	//$("#browserSupported").html("Your browser is supported.");
	navigator.geolocation.getCurrentPosition(function(position){
	    latitude = position.coords.latitude;
	    longitude = position.coords.longitude;
	    var location = "Lat: " + latitude + ", Long: " + longitude;    
	    $("#yourLatLong").html(location);
            
	    var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	    geocoder.geocode({'latLng': pos}, function(results, status){
		if (status == google.maps.GeocoderStatus.OK){
		    var components = results[1].address_components;
		    
		    /*Get the city, state and country.*/
		    for (i in components){
			var compTypes = components[i].types
			for (j in compTypes){
			    if (compTypes[j] == 'locality'){
				city = components[i].short_name;
			    }
			    if (compTypes[j] == 'administrative_area_level_1'){
				state = components[i].short_name;
			    }
			    if (compTypes[j] == 'country'){
				country = components[i].short_name;
			    }
			}
		    }
		    $("#yourLocation").html("Your Location: " + city + ", " + state + ", " + country);
		    
		}
		else{
		    $("#yourLocation").html("Error: " + status + ".");
		}
	    });
	},
						 function(error){
						     $("#error").html("Error: " + geolocationErrorMessages[error.code] + ".");
						 },
						 {enableHighAccuracy: true, maximumAge:120000});
    }
    else{
	$("#browserSupported").html("Your browser is not supported");
    }
});