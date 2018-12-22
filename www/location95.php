<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(95, $db);
    
    $char_collected = check_for_character('cara Cooper', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'cara Cooper') {
            add_location_clue(95, $db);
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
<img src=assets/location.png>
<h2>Placeholder</h2>

<p>Loosing a letter from fast is one reason why you might not be.</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'cara Cooper', $db);
        print "<img src=assets/cara_Cooper.png align=left>";
        print "<p>Cara Cooper is here. She has a first aid kit.</p>";
        print "<p>You can read about Cara in:</p>";
        add_fanfic(28,$db);
        print_fanfic(28,$db);
    }
    
    print_footer(95, $db);
    ?>


</div>
</body>
</html>
