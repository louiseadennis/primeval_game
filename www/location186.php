<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(186, $db);
    
    $char_collected = check_for_character('annie Morris', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'annie Morris') {
            add_location_clue(186, $db);
            add_equipment("budget", $db);
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
    
    if (!$char_collected) {
        update_users("new_character", 'annie Morris', $db);
        print "<img src=assets/annie_Morris.png align=left>";
        print "<p>Annie Morris is here. She says she must talk to Lester about your budget.  In fact she's been given a note saying you should bid.</p>";
    }
    

print_footer(186, $db);
?>
</div>
</body>
</html>
