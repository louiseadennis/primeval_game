<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(35, $db);
    add_location_clue(35,$db);

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
print_critter_trail_start(15,$db);
?>
<div class=location>
<img src=assets/location35.png>
<h2>Rocky Cliffs</h2>

<p>You stand atop rocky cliffs.  Pteranodon circle below you.  Into the cliffs are carved the words Bunnies: Beginning middle and end</p>

<?php
    print_footer(35,$db);
    ?>

</div>
</body>
</html>
