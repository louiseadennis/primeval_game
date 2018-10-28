<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
    check_location(174, $db);
    add_location_clue(174, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $claudia_collected = 1;
    $claudia_collected = check_for_character('claudia', $db);
    if (!$claudia_collected) {
        $visited = get_value_from_users("new_character", $db);
        if ($visited != 'claudia') {
            add_equipment("budget", $db);
        }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location.png>
<h2>Placeholder</h2>


<?PHP
    if (!$claudia_collected) {
        update_users("new_character", 'claudia', $db);
        print "<img src=assets/claudia.png align=left>";
        print "<p>Claudia is  here.</p>";
        
        print "<p>Claudia is holding a misspelled name badge that reads `Claudia BrowNE'</p>";
    } else {
        print "<p>This is where you met Claudia holding a misspelled name badge that reads `Claudia BrowNE'</p>";
    }
?>
</div>
</body>
</html>