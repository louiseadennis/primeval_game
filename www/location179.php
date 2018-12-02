<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(179, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $ange_collected = check_for_character('ange',$db);
    if (!$ange_collected) {
        $visited =  get_value_from_users("new_character", $db);
        if ($visited != 'ange') {
            add_equipment("budget", $db);
            add_location_clue(179, $db);
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
    if (!$ange_collected) {
        update_users("new_character", 'ange', $db);
        print "<img src=assets/ange.png align=left>";
        print "<p>Ange is here.  She promises you more budget.  She says she was given a mysterious cigarette but doesn't know  why.</p>";
    }
    ?>

</div>
</body>
</html>
