<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(80, $db);
    add_location_clue(80,$db);

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
print_critter_trail_start(23,$db);
?>
<div class=location>
<img src=assets/location80.png>
<h2>Beside a pool</h2>

<p>You stand beside a pool where labyrinthodontia fish.  Someone has scratched 'start to ensure' into a rock</p>

<?php
    print_footer(80,$db);
    ?>

</div>
</body>
</html>
