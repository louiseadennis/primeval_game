<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(190, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $stephen_collected = check_for_character('stephen', $db);
    if (!$stephen_collected) {
        $visited = get_value_from_users("new_character", $db);
        if ($visited != 'stephen') {
            add_equipment("tranquiliser rifle", $db);
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

<p>Placeholder</p>
<?php
    if (!$stephen_collected) {
        update_users("new_character", "stephen", $db);
        print "<img src=assets/stephen.png align=left>";
        print "<p>Stephen is here.  He has a tranquiliser rifle with darts.  He says he has no clue but was told to return to the ARC.</p>";
    }
    ?>
</div>
</body>
</html>
