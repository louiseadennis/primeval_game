<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(10, $db);

    $sid_collected = check_for_character('sid', $db);
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
<img src=assets/location10.png>
<h2>A Hot Desert</h2>

<p>You are standing in a hot desert surrounded by diictodon burrows.</p>

<?php
    
    if (!$sid_collected) {
        update_users("new_character", "nancy", $db);
        update_users("new_character", "sid", $db);
        print "<img src=assets/sid.png align=left> <img src=assets/nancy.png align=left>";
        print "<p>Sid and Nancy are here.  They leap out of their burrow and run eagerly towards you.</p>";
    }
    ?>
</div>
</body>
</html>
