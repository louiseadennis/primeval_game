<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(144, $db);
    add_location_clue(144, $db);

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
<img src=assets/location144.png>
<h2>A forest in the Cretaceous</h2>

<p>You are in a primeval forest.  Strange cries echo on the air and strange creatures fly overhead.  A page, apparently torn from a textbook, has been nailed to a tree saying: A secondary electron and back-scattered electron detector used in scanning electron microscopes</p>

<?php
print_footer(144, $db);
?>
</div>
</body>
</html>
