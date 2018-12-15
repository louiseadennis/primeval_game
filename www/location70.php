<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(70, $db);

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
<img src=assets/location70.png>
<h2>A Cave in the Snow</h2>

<p><i>The two men had stumbled into a cave at the base of a high-sided cliff, flurries of fat white flakes swirling around them. A brief glance around had shown them that they weren’t the cave’s first inhabitants. A rough hearth of stones contained the remains of a fire and there was a stack of wood and dried moss further into the cave, but the blackened wood was cold and there were no signs of recent occupation. Lyle had stared at a mass of flint flakes on the floor near to the fire and had informed Ryan that they had probably stumbled on a temporary encampment for hunting parties. The captain had deferred to his companion’s greater knowledge of caves and archaeology.</i></p>

<?php
    add_fanfic(11, $db);
    print "To find  out more: ";
    print_fanfic(11, $db);
    
    print_footer(70, $db);
    ?>


</div>
</body>
</html>
