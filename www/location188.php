<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(188, $db);
    add_location_clue(188,$db);

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
print_critter_trail_start(43, $db);
?>
<div class=location>
<img src=assets/location188.png>
<h2>A Partially Sunken City</h2>

<p>You are in the ruins of a city that is becoming submerged under water.  African National Congress banners hang from the windows.</p>

<?php
print_footer(188, $db);
?>
</div>
</body>
</html>
