<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(113, $db);

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
<img src=assets/location113.png>
<h2>A Dusty Plain</h2>

<p>You are standing in a dusty plain.  A few small seed ferns grow here and there and what look like conifers are visible in the distance.  Large animals such as therocephalians and scutosaurus roam the plain.</p>

</div>
</body>
</html>
