<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(147, $db);
    add_location_clue(147,$db);

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
print_critter_trail_start(6, $db);
?>
<div class=location>
<img src=assets/location147.png>
<h2>Permian Desert</h2>

<p>You are standing in a dry and dusty Permian landscape.  As you arrive a disembodied voice intones `Air Training Corps'</p>

<?php
print_footer(147, $db);
?>
</div>
</body>
</html>
