<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(191, $db);

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
<img src=assets/location191.png>
<h2>A Sandy Desert</h2>

<p>You find yourself standing on a rocky outcrop in the middle of a sea of sand.  The air is low in oxygen which makes it hard, but not impossible, to breathe.
<?php
    
    $action_done = get_value_from_users("action_done", $db);
    if ($action_done) {
        print "<b>You must use breathing apparatus or take damage.</b>";
    }
    ?>

</div>
</body>
</html>
