<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(13, $db);
    add_location_clue(13,$db);

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
print_critter_trail_start(22, $db);
?>
<div class=location>
<img src=assets/location13.png>
<h2>A Mountain Range</h2>

<p>You are high up on a Mountain overlooking a vast forest.  You can see what appear to be giant dragonflies flitting up above the trees.  Into the rock of the mountain someone has carved `was he a Fellow of the Royal Society?'</p>

<?php
    print_footer(13, $db);
    ?>

</div>
</body>
</html>
