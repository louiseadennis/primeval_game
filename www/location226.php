<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(226, $db);

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
    print_sanctuary_start($db);
    $sanctuary_visits = get_value_from_users("sanctuary", $db);
    $fanfic_id = get_value_for_sanctuary_id("fanfic_id", 3, $db);
    
    ?>
<div class=location>
<img src=assets/location226.png>
<h2>Sanctuary Bathroom</h2>

<i><p>"Hello, Management?"</p>

<p>"Yes, Ryan, what can we do for ... is that eyeliner?"</p>

<p>"Yes, and could you tell me how I can get the sodding stuff off? Camouflage face paint is bad enough, but at least that comes off with soap and water."</p></i>

<?php


    add_fanfic($fanfic_id, $db);
    print "<p>Now read on: ";
    print_fanfic($fanfic_id, $db);
    
    print_accessible_location_foot(224, $db);
    
    print_footer(224, $db);
    ?>

</div>
</body>
</html>
