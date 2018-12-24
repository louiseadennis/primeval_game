<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(154, $db);
    add_location_clue(154,$db);

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
print_critter_trail_start(154,$db);
?>
<div class=location>
<img src=assets/location154.png>
<h2>A Cretaceous Plain</h2>

<p>You find yourself in the middle of a grassy plain surrounded by Triceratops.  In the sky the clouds have formed a message: `Start with a Dodo'</p>

<?php
print_footer(154, $db);
?>
</div>
</body>
</html>
