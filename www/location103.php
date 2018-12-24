<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(103, $db);
    $char_collected = check_for_character('matt Rees', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'matt Rees') {
            add_location_clue(103, $db);
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

<p>Start of the Eocene</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'matt Rees', $db);
        print "<img src=assets/matt_Rees.png align=left>";
        print "<p>Matt Rees is here.  He has a first aid kit.</p>";
    }
    
    print_footer(103,$db);
    ?>


</div>
</body>
</html>
