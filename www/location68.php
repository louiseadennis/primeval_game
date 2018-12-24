<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(68, $db);
    add_location_clue(68,$db);

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
print_critter_trail_start(28,$db);
?>
<div class=location>
<img src=assets/location.png>
<h2>Placeholder</h2>

<p>Sea and Sea</p>

<?php
    print_footer(68, $db);
    ?>

</div>
</body>
</html>
