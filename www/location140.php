<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(140, $db);
    add_location_clue(140,$db);

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
print_critter_trail_start(34, $db);
?>
<div class=location>
<img src=assets/location140.png>
<h2>A Forest of Conifers and Seed Ferns</h2>

<p>You are standing in a small clearing in a forest of conifers and seed ferns. Through the trees you can see a Stegosaurus in the undergrowth.  A piece of paper floats on the air.  You grab it and read `tie it backwards'</p>

<?php
    print_footer(140,$db);
    ?>

</div>
</body>
</html>
