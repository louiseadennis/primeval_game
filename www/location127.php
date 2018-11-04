<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(127, $db);

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
<img src=assets/location127.png>
<h2>A Dark Forest</h2>

<p>You are standing in a dark forest surrounded by tall trees with thick trunks.  These trunks rarely branch but are topped with a crown of branches bearing clusters of leaves which are long and narrow.  Vast insects dart among the trees.</p>

</div>
</body>
</html>
