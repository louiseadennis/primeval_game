<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(33, $db);
    
    $char_collected = check_for_character('captain Ross', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'captain Ross') {
            add_location_clue(33, $db);
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

<p>Fish, liable to cause wars.</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'captain Ross', $db);
        print "<img src=assets/captain_Ross.png align=left>";
        print "<p>Captain Ross is here.</p>";
    }
    ?>


<?php
    print_footer(33, $db);
    ?>


</div>
</body>
</html>
