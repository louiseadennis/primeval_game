<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(126, $db);

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
<img src=assets/location126.png>
<h2>A Freshwater Lake</h2>

<p>You are in the middle of a freshwater lake in which giant fish are swimming.  You can see huge trees lining the shores of the lake.  The air is warm and humid.</p>
<?php
    
    $action_done = get_value_from_users("action_done", $db);
    if (!$action_done) {
        print "<p><b>You will need a boat otherwise you will be swept out of the anomaly again!</b></p>";
    }
    ?>


</div>
</body>
</html>
