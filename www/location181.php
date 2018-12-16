<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(181, $db);
    
    $char_collected = check_for_character('liz Lester', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'liz Lester') {
            add_location_clue(181, $db);
            add_equipment("knife", $db);
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

<p>Runner Sebastian</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'liz Lester', $db);
        print "<img src=assets/liz_Lester.png align=left>";
        print "<p>Liz Lester is here. She has a knife</p>";
    }

print_footer(181, $db);
?>
</div>
</body>
</html>
