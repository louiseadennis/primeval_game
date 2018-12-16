<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(44, $db);
    
    $char_collected = check_for_character('morris', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'morris') {
            add_location_clue(44, $db);
            add_equipment("trowel", $db);
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
<img src=assets/location44.png>
<h2>A Peaceful River</h2>

<p>A riverside with a variety of tress and grasses.  Into a tree is carved the works `Short robot'</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'morris', $db);
        print "<img src=assets/morris.png align=left>";
        print "<p>Morris is here.  She has a trowel.</p>";
    }
    
    
    print_footer(44, $db);
    ?>


</div>
</body>
</html>
