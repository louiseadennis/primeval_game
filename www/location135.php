<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(135, $db);
    
    $char_collected = check_for_character('christine', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'christine') {
            add_location_clue(135, $db);
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

<p>End of the drafts.</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'christine', $db);
        print "<img src=assets/christine.png align=left>";
        print "<p>Christine is here.</p>";
    }
    ?>


<?php
print_footer(135, $db);
?>
</div>
</body>
</html>
