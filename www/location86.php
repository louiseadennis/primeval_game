<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(86, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $nick_collected = check_for_character('nick', $db);
    if (!$nick_collected) {
        add_location_clue(86, $db);
        $visited = get_value_from_users("new_character", $db);
        if ($visited != 'nick') {
            add_fanfic(1, $db);
            // maybe do something?
        }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location86.png>
<h2>Moutains above the salt plains of Salar de Surire</h2>

<i><p>If he hadn't been sitting on top of a crashed helicopter fuselage with two dead bodies inside, Blade would have whistled with admiration. In the pale evening sunlight, there was an incredible vista before him. The wreck was tucked into the side of a dark grey jagged mountainside, and down below there stretched away into the distance a flat, white expanse. The salt plains of Salar de Surire.</p></i>

<?php
    if (!$nick_collected) {
        update_users("new_character", 'nick', $db);
        print "<img src=assets/nick.png align=left>";
        print "<p>Nick is holding a piece of paper and looking horrified.</p><p>\"I was told this was a clue,\" he says, \"what is it?!?!?\"</p>";
        print "<p>You examine the paper it is ";
        print_fanfic(1, $db);
    }
    
    print_travel(86,$db);
    print_footer(86,$db);
?>

</div>
</body>
</html>
