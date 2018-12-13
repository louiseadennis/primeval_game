<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(50, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $dylan_collected = check_for_character('dylan', $db);
    if (!$dylan_collected) {
        add_location_clue(50, $db);
        $visited = get_value_from_users("new_character", $db);
        if ($visited != 'dylan') {
            add_equipment("tranquiliser rifle", $db);
        }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location50.png>
<h2>Rocky Cliffs above the Sea</h2>

<p>You are standing on rocky cliffs above a sea.  Not far from you is a colony of far future mer-creatures.  Carved  into the rocks are the words `Apparently its a machine for exercising rowers gently.'</p>
<?php
    if (!$dylan_collected) {
        update_users("new_character", "dylan", $db);
        print "<img src=assets/dylan.png align=left>";
        print "<p>Dylan is here.  She has a tranquiliser rifle with darts.</p>";
    }
    ?>

</div>
</body>
</html>
