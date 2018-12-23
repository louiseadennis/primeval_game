<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(130, $db);
    add_location_clue(130, $db);

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
<img src=assets/location130.png>
<h2>A Creteaceous Plain.</h2>

<p>There isn't much vegetation here, but you hide behind a rock hoping  to avoid the attention of the local T-Rex.  On the rock someone has scratched `At, Ate, _, Date'</p>

<?php
    print_footer(130, $db);
    ?>

</div>
</body>
</html>
