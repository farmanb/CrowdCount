<html>
  <head>
    <title>Today's Date</title>
  </head>
  <body>
    <p>Today's date (according to this Web Server) is
      <?php
	 date_default_timezone_set('America/New_York');
	 echo(date ("F dS Y.") );
	 ?>
  </body>
</head>
