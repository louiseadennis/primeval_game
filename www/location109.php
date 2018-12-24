<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(109, $db);
    add_location_clue(109,$db);

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
print_critter_trail_start(57, $db);
?>
<div class=location>
<img src=assets/location109.png>
<h2>A Theatre</h2>

<p>You are standing in the auditorium of a large theatre.  The letter &Ntilde; has been painted on the stage.</p>

<?php
    print_travel(109, $db);
    print_footer(109, $db);
    ?>

</div>
</body>
</html>
