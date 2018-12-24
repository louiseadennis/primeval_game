<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(83, $db);

    $char_collected = check_for_character('fiver', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'fiver') {
            add_location_clue(83, $db);
            add_equipment("inflatable dinghy", $db);
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
<img src=assets/location83.png>
<h2>A Coral Reef</h2>

<p>You are in the middle of a wide ocean, though you can see a reef beneath you with ammonites swimming about.</p>

<?php
    
    $action_done = get_value_from_users("action_done", $db);
    if (!$action_done && $char_collected) {
        print "<p><b>You will need a boat otherwise you will be swept out of the anomaly again!</b></p>";
    } else if (!$char_collected) {
        update_users("new_character", 'fiver', $db);
        print "<img src=assets/fiver.png align=left>";
        print "<p>Fiver is here in an inflatable dinghy.  He has been given a picture: <img src=assets/buffy_title_card.png></p>";
    }
    
    print_footer(83,$db);
?>

</div>
</body>
</html>
