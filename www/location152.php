<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(152, $db);
    add_location_clue(152,$db);

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
print_critter_trail_start(16,$db);
?>
<div class=location>
<img src=assets/location152.png>
<h2>The  Shores of a Lake</h2>

<p>You are standing on the shores of a lake.  You can see a spinosaurus diving for fish out on hte water.  Into the sand at the shore has been drawn a picture of Dora the Explorer</p>

<?php
print_footer(152, $db);
?>
</div>
</body>
</html>
