<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(104, $db);
    add_location_clue(104,$db);

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
print_critter_trail_start(3,$db);
?>
<div class=location>
<img src=assets/location104.png>
<h2>The Forest of Dean</h2>

<p>You are standing in the Forest of Dean near the site of the original anomaly.  The ARC maintains a permanent presence here because of the large number of anomalies.  Someone has set up a signpost next to the anomaly that says `Start to be free'.</p>

<?php
    print_travel(104, $db);
    print_footer(104, $db);
    ?>

</div>
</body>
</html>
