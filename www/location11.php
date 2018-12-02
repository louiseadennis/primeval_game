<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(11, $db);

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
<img src=assets/location11.png>
<h2>A Medieval Village</h2>

<p>You are standing on a muddy road with small cottages alongside it made from stone and wood.  There is a tiny church at the end of the street next to where you are standing.  Several of the cottages have a pig or chickens penned nearby.</p>

<p>One grave in the churchyard catches your eye.  It has a trilobite carved into the headstone.  It says Ann Newsom Hughes, 1334-1372.</p>

</div>
</body>
</html>
