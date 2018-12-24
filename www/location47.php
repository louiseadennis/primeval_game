<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(47, $db);
    add_location_clue(47, $db);

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
print_critter_trail_start(39,$db);
?>
<div class=location>
<img src=assets/location.png>
<h2>Placeholder</h2>

<p>An intense and widely shared enthusiasm for something, especially one that is short-lived; a craze.</p>

<?php
    print_footer(47,$db);
    ?>

</div>
</body>
</html>
