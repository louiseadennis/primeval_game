<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(128, $db);
    add_location_clue(128,$db);

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
print_critter_trail_start(46, $db);
?>
<div class=location>
<img src=assets/location128.png>
<h2>A Plain at Sunset</h2>

<p>You are standing on a grassy plain at sunset.  Somewhere a hyaenodon howls.  A sign post has been erected.  The sign reads `a minor extinction event at the end of the Carboniferous'</p>

<?php
print_footer(128, $db);
?>
</div>
</body>
</html>
