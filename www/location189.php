<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(189, $db);
    add_location_clue(189,$db);

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
print_critter_trail_start(18,$db);
?>
<div class=location>
<img src=assets/location189.png>
<h2>A Plain with grazing animals</h2>

<p>You are looking out over a plain of grazing animals.  Someone from CID has dropped their ID badge.</p>

<?php
print_footer(189, $db);
?>
</div>
</body>
</html>
