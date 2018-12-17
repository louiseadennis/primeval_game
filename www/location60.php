<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(60, $db);
    
    $char_collected = check_for_character('helena Ramsey', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'helena Ramsey') {
            add_location_clue(60, $db);
            add_equipment("tranquiliser rifle", $db);
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

<p>The oldest bank in mainland China still in existence.</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'helena Ramsey', $db);
        print "<img src=assets/helena_Ramsey.png align=left>";
        print "<p>Helena Ramsey is here.  She has a tranquiliser rifle.</p>";
    }
    
    
    print_footer(60, $db);
    ?>



</div>
</body>
</html>
