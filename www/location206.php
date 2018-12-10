<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(206, $db);
    
    $howard_collected = check_for_character('howard Kanan', $db);
    if (!$howard_collected) {
        add_equipment("ADD", $db);
    }

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
<img src=assets/location206.png>
<h2>A Forest Tack</h2>

<p>You are standing on a track through a forest.  It seems to have been made by the large herd of Triceratops you can see ahead of you.</p>

<?php
    
    if (!$howard_collected) {
        update_users("new_character", "howard Kanan", $db);
        print "<img src=assets/howard_Kanan.png align=left>";
        print "<p>Howard Kanan  is here watching the Tricertops.  He has a home made anomaly detection device.</p>";
    }
    ?>

</div>
</body>
</html>
