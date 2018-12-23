<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(27, $db);
    add_location_clue(27, $db);

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
print_critter_trail_start(26,$db);
?>
<div class=location>
<img src=assets/location27.png>
<h2>Marshy Pools</h2>

<p>You are standing in a landscape of marshy pools.  An Eryops flops about in the water of one of the larger ones.  A post as been hammered into the mud and onto it is carved `A Cottage before each Vowel'</p>

<?php
    print_footer(27, $db);
    ?>

</div>
</body>
</html>
