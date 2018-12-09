<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(58, $db);
    
    $char_collected = check_for_character('hamza Sayed', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'hamza Sayed') {
            add_location_clue(58, $db);
            add_equipment("first aid kit", $db);
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
<img src=assets/location58.png>
<h2>The Edge of a Floodplain</h2>

<p>You are standing on a small hillock in the middle of a flooded plain.  In the distance you can make out where you think the river must be.   A small pack of Coelophysis dart across the muddy ground, wading through pools of water and, it would appear, hunting for lizards.</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'hamza Sayed', $db);
        print "<img src=assets/hamza_Sayed.png align=left>";
        print "<p>Hamza Sayed is here.  He has a first aid kit.  He says he was told to see a sea.</p>";
    }
    ?>


</div>
</body>
</html>
