<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(121, $db);
    $rex_collected = check_for_character('rex', $db);


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
<img src=assets/location121.png>
<h2>A Dusty Plain</h2>

<p>You are standing in a dusty plain surrounded by conifers, with a volcano in the distance.  Coelurosauravus' circle overhead.</p>

<?php
    
    if (!$rex_collected) {
        update_users("new_character", "rex", $db);
        print "<img src=assets/rex.png align=left>";
        print "<p>Rex is here.  He flies down into your arms.</p>";
    }
    ?>

</div>
</body>
</html>
