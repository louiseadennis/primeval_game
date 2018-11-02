<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(58, $db);

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
<img src=assets/location58.png>
<h2>The Edge of a Floodplain</h2>

<p>You are standing on a small hillock in the middle of a flooded plain.  In the distance you can make out where you think the river must be.   A small pack of Coelophysis dart across the muddy ground, wading through pools of water and, it would appear, hunting for lizards.</p>

</div>
</body>
</html>
