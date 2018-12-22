<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(132, $db);
    add_location_clue(132,$db);

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
print_critter_trail_start(2, $db);
?>
<div class=location>
<img src=assets/location132.png>
<h2>The Open Ocean</h2>

<p>You are in a vast open ocean!  Nevertheless a wooden plank is floating near you with the words `Equally Divided Clothed'</p>

<?php
    $action_done = get_value_from_users("action_done", $db);
    if (!$action_done) {
        print "<p><b>You will need a boat otherwise you will be swept out of the anomaly again!</b></p>";
    }
print_footer(132, $db);
?>
</div>
</body>
</html>
