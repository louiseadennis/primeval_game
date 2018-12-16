<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(93, $db);
    
    $char_collected = check_for_character('claire Bradley', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'claire Bradley') {
            add_location_clue(93, $db);
            add_equipment("breathing aparatus", $db);
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
<img src=assets/location93.png>
<h2>A Tidal Flat at Sunset</h2>

<p>You are on the banks of a beach or tidal flat at sunset.  Nothing much appears to be growing on land, but there are mat like structures floating in pools left behind by the receding tide.  Layered biological seeming structures also cluster in the shallows.</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'claire Bradley', $db);
        print "<img src=assets/claire_Bradley.png align=left>";
        print "<p>Claire Bradley is here. She has breathing aparatus.  She has been given some kind of lettuce.</p>";
    }
    
    print_footer(93, $db);
    ?>

</div>
</body>
</html>
