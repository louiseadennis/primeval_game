<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(151, $db);
    
    $mac_collected = check_for_character('mac', $db);
    if (!$mac_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'mac') {
            add_location_clue(151, $db);
            add_equipment('assault rifle', $db);
        }
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
<img src=assets/location.png>
<h2>Placeholder</h2>

<p>DeonTiC Logic</p>

<?php
    
    if (!$mac_collected) {
        update_users("new_character", 'mac', $db);
        print "<img src=assets/mac.png align=left>";
        print "<p>Mac is here.  He has an assault rifle.</p>";
    }
    
    ?>

</div>
</body>
</html>
