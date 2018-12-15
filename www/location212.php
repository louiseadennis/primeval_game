<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(212, $db);
    
    $char_collected = check_for_character('major Douglas', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'major Douglas') {
            add_location_clue(212, $db);
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
<img src=assets/location212.png>
<h2>An Abandoned Camp</h2>

<p>You are in the middle of a forest of conifers and leafy trees.  Someone seems to have been camping here.  You can see traces of a fire pit and hand-made wooden spears inside the remains of a makeshift hut made from tree roots.   Tin cans are suspended from string around the area.  You think this must be where Connor and Abby lived for a year.</p>

<?php
    
        
        if (!$char_collected) {
            update_users("new_character", 'major Douglas', $db);
            print "<img src=assets/major_Douglas.png align=left>";
            print "<p>Major Douglas is here.  He has been given some binoculars and told they were for 20 20 vision.</p>";
        }
        
    

print_footer(212, $db);
?>
</div>
</body>
</html>