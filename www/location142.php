<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(142, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $abby_collected = check_for_character('abby', $db);
    if (!$abby_collected) {
        add_location_clue(142, $db);
        $visited = get_value_from_users("new_character", $db);
        if ($visited != 'abby') {
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

<p>A reverse trip to Goa.</p>
<?php
    if (!$abby_collected) {
        update_users("new_character", "abby", $db);
        print "<img src=assets/abby.png align=left>";
        print "<p>Abby is here.  She has a tranquiliser rifle with darts.</p>";
    }
?>

</div>
</body>
</html>
