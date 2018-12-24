<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(97, $db);
    add_location_clue(97,$db);

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
print_critter_trail_start(47, $db);
?>
<div class=location>
<img src=assets/location97.png>
<h2>A desert and a crashed plane.</h2>

<p>You are standing in a dry, dusty landscape next to a crashed plane. A box of bic biros stands next to the plane.</p>

<?php
    print_footer(97, $db);
    ?>

</div>
</body>
</html>
