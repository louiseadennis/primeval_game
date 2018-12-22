<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(209, $db);
    add_location_clue(209, $db);

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
print_critter_trail_start(5, $db);
?>
<div class=location>
<img src=assets/location209.png>
<h2>A Herd of Scutosaurus</h2>

<p>You are standing on a hillside observing a herd of Scutosaurus.  Into the wood of a tree is carved:  I'm all in fine, my first  is in forest and my ending in Tyne.</p>

<?php
print_footer(209, $db);
?>
</div>
</body>
</html>
