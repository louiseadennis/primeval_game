<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(12, $db);

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
<img src=assets/location12.png>
<h2>High Ground</h2>

<p>You are standing on high ground above a plain containing confiers and seed ferns.  A scrap of paper is pinned down with a rock.  It reads `The sisters again, but this time my third is the King who ordered my first entombed.'</p>

</div>
</body>
</html>
