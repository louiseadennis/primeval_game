<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(46, $db);
    add_location_clue(46,$db);

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
print_critter_trail_start(20,$db);
?>
<div class=location>
<img src=assets/location46.png>
<h2>A Deserted Highway</h2>

<p>You are standing on a deserted highway.  A rusting car has been abandoned here.  Its windows long  since smashed.  A dry wind carries a strange acidic smell on the air. Someone has spray-painted `second person plural of to be' onto the car.</p>

<?php
    print_footer(46,$db);
    ?>

</div>
</body>
</html>
