<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(67, $db);
    
    $char_collected = check_for_character('kermit', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'kermit') {
            add_location_clue(67, $db);
            add_equipment("hand gun", $db);
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

<p>A Swamp</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'kermit', $db);
        print "<img src=assets/kermit.png align=left>";
        print "<p>Kermit is here.  He has a hand gun.</p>";
    }
    ?>

</div>
</body>
</html>
