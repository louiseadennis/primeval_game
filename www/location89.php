<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(89, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($db);
    add_location_clue(89, $db);
?>
<div class=main>
<?php
print_critter_trail_start(4, $db);
?>
<div class=location>
<img src=assets/location89.png>
<h2>A Pleistocene Plain</h2>

<p>You are standing on the edge of a plain teeming with Pleistocene wild life.  Someone has left a copy of the Dungeons and Dragons Player's Handbook here.</p>

<?php
    print_footer(89, $db);
    ?>

</div>
</body>
</html>
