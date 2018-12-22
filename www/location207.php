<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(207, $db);

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
print_critter_trail_start(14, $db);
?>
<div class=location>
<img src=assets/location207.png>
<h2>High Cliffs</h2>

<p>You are standing on high cliffs.  Below you the cliffs are full of the nests of Anurognathus.  Into the cliffs have been carved some strange marks: - . - . / - . / ...</p>

<?php
    add_location_clue(207, $db);
    print_footer(207, $db);
    ?>
</div>
</body>
</html>
