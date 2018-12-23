<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(79, $db);
    add_location_clue(79,$db);

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
print_critter_trail_start(13, $db);
?>
<div class=location>
<img src=assets/location79.png>
<h2>An Office Block</h2>

<p>The corridors of the office are filled with poisonous smoke, though you can breath if you keep your head above it.  The office photocopier is stuck in a loop printing an information sheet about the Applicant Tracking System.</p>

<?php
    print_travel(79, $db);
    print_footer(79, $db);
    ?>

</div>
</body>
</html>
