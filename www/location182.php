<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(182, $db);
    add_location_clue(182,$db);
    

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
print_critter_trail_start(55, $db);
?>
<div class=location>
<img src=assets/location182.png>
<h2>A Nuclear Submarine Base</h2>

<p>You find yourself in a nuclear submarine base.  They tell you they have recieved a package for you when you open it you find an Attack on Titan comic.</p>

<?php
    print_travel(182, $db);
print_footer(182, $db);
?>
</div>
</body>
</html>
