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

check_location(55, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css?v=1" type="text/css">
</head>
<body>
<?php
print_header($mysql);

$phase = get_user_phase($mysql);
$douglas_collected = check_for_character('major Douglas', $mysql);

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location55.png>
<h2>A Forest Pool</h2>

<p>You are standing on the edge of a pool in a forest of ferns and conifers.  Many animals come here to drink including therocephalians.</p>

<?php

if (!$douglas_collected & $phase > 4) {
     update_users("new_character", "major Douglas", $mysql);
     print "<img src=assets/major_Douglas.png align=left>";
     print "<p>Major Douglas is here.  He says Helen left Colonel Hall in the Carboniferous.</p>";
     add_location_clue(55, $mysql);
}
?>
</div>
</body>
</html>