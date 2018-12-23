<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(99, $db);
    add_location_clue(99,$db);

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
print_standard_start($db);
?>
<div class=location>
<img src=assets/location99.png>
<h2>A Neotropical Rainforest.</h2>

<p>You are standing in a hot and humid rain forest.  A damp piece of paper says `Bounce 145'</p>

<?php
    print_footer(99, $db);
    ?>

</div>
</body>
</html>
