<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(198, $db);

    $blade_collected = check_for_character('blade', $db);
    if (!$blade_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'blade') {
            add_location_clue(198, $db);
            add_equipment("knife", $db);
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

<p>Middle Caucasian</p>

<?php
    
    if (!$lyle_collected) {
        update_users("new_character", 'blade', $db);
        print "<img src=assets/blade.png align=left>";
        print "<p>Blade is here.  He lends you a knife.</p>";
    }
    
    ?>

</div>
</body>
</html>
