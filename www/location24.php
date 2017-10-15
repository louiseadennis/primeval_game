<?php 
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!mysql_select_db($mysql_database))
  showerror();

check_location(24, $mysql);
add_location_clue(24, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);

$phase = get_user_phase($mysql);

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location24.png>
<h2>A Medieval Village</h2>

<p>You are standing on a muddy road with small cottages alongside it made from stone and wood.  There is a tiny church at the end of the street next to where you are standing.  Several of the cottages have a pig or chickens penned nearby.  In the churchyard you spot a new looking gravestone with the words:</p>

<p>DANIEL A QUINN<br>
1208-1217<br>
No Backwards</p>

</div>
</body>
</html>