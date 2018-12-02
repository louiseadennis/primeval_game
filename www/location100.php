<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(100, $db);

    $lyle_collected = check_for_character('lyle', $db);
    if (!$lyle_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'lyle') {
            add_location_clue(100, $db);
            add_equipment("assault rifle", $db);
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
<img src=assets/location100.png>
<h2>A Tropical Island</h2>

<p>You are standing on the beach of what feels like a warm tropical island.  Archeopteryx can be seen circling above the tops of the palm-like trees.  Someone has written the words Bishop International Airport in the sand.</p>

<?php
    
    if (!$lyle_collected) {
        update_users("new_character", 'lyle', $db);
        print "<img src=assets/lyle.png align=left>";
        print "<p>Lyle is here.  He has an assault rifle.</p>";
    }
    
    ?>

</div>
</body>
</html>
