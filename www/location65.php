<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(65, $db);
    
    $char_collected = check_for_character('burton', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'burton') {
            add_location_clue(65, $db);
            add_equipment("budget", $db);
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
<img src=assets/location65.png>
<h2>A Lake Shore</h2>

<p>You are standing on the shores of a lake.  Flying reptiles dart overhead which you identify as Eudimorphodons.</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'burton', $db);
        print "<img src=assets/burton.png align=left>";
        print "<p>Burton is here.  He agrees you need a bigger budget.  He seems quite put out that someone suggested he was a baddie.</p>";
    }
    
    print_footer(65, $db);
    ?>

</div>
</body>
</html>
