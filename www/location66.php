<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(66, $db);
    add_location_clue(66,$db);

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
print_critter_trail_start(54, $db);
?>
<div class=location>
<img src=assets/location66.png>
<h2>A Rocky Landscape</h2>

<p>You are standing in a rocky landscape.  Strange green plants cover the ground but nothing tall can be seen.  The air seems very thin, making you hyperventilate.  Someone has written 'Fie, fie' in the sand.</p>

<?php
    print_footer(66,$db);
    ?>

</div>
</body>
</html>
