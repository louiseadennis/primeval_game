<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(93, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($db);
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location93.png>
<h2>A Tidal Flat at Sunset</h2>

<p>You are on the banks of a beach or tidal flat at sunset.  Nothing much appears to be growing on land, but there are mat like structures floating in pools left behind by the receding tide.  Layered biological seeming structures also cluster in the shallows.</p>

</div>
</body>
</html>
