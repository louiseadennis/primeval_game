<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(74, $db);
    
    $tobie_collected = check_for_character('tobie', $db);
    if (!$tobie_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'tobie') {
            add_location_clue(74, $db);
            add_equipment('first aid kit', $db);
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

<p>Placeholder</p>

<?php
    
    if (!$tobie_collected) {
        update_users("new_character", 'tobie', $db);
        print "<img src=assets/tobie.png align=left>";
        print "<p>Tobie is here.  She has a first aid kit.  She suggests returning to the ARC.</p>";
    }
    
    ?>

</div>
</body>
</html>
