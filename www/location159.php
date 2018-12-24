<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(159, $db);
    add_location_clue(159, $db);

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
print_critter_trail_start(58,$db);
?>
<div class=location>
<img src=assets/location159.png>
<h2>The Centre of Nottingham</h2>

<p>Martin had his phone pressed to his ear, trying to juggle that, the box of doughnuts he'd just brought from Doughnotts, and navigate his way back up the steep steps to daylight and the Market Square. So intent was he on not dropping anything and getting back to the office that he didn't spot the shiny light floating in front of the Council House until he walked into the back of one of the teenagers filming it on their phones. </p>

<?php
    add_fanfic(39, $db);
    print "<p>Now Read On:</p>";
    print_fanfic(39, $db);
    
    
    print "<p>A traffic sign has been replaced to read ATD</p>";
    
    print_footer(159, $db);
?>
</div>
</body>
</html>
