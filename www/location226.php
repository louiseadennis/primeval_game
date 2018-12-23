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
    if ($sanctuary_visits < 4) {
        $fanfic_id = get_value_for_sanctuary_id("fanfic_id", 3, $db);
    } else if ($sanctuary_visits == 4) {
        $fanfic_id = get_value_for_sanctuary_id("fanfic_id", 4, $db);
    } else {
        $fanfic_id = get_value_for_sanctuary_id("fanfic_id", 5, $db);
    }
    
    ?>
<div class=location>
<img src=assets/location226.png>
<h2>Sanctuary Bathroom</h2>

<?php
    if ($sanctuary_visits < 4) {
        print "<i><p>\"Hello, Management?\"</p>";

        print "<p>\"Yes, Ryan, what can we do for ... is that eyeliner?\"</p>";

        print "<p>\"Yes, and could you tell me how I can get the sodding stuff off? Camouflage face paint is bad enough, but at least that comes off with soap and water.\"</p></i>";
    } else if ($sanctuary_visits == 4){
        print "<i><p>Ryan was enjoying a leisurely shower when he heard someone knocking on the door. Well, not just someone, given that the only other person here was Stephen. It couldn’t be anyone else. Although the fact that he bothered to knock was a bit strange. Either way, Ryan just called out, \“Come in,\” and carried on showering.</p>";
        
        print "<p>“Wait a min- bloody hell!”</p>";
        
        print "<p>Ryan spun round, and grabbed a towel when he saw Connor standing in the doorway with a stunned expression.</p></i>";
    } else {
        print "<i><p>“Stephen?”</p>";
        
        print "<p>“Management?”</p>";
        
        print "<p>“What’s the matter with Ryan?”</p>";
        
        print "<p>Stephen shuffled his feet, and looked uncomfortable.</p></i>";
    }



    add_fanfic($fanfic_id, $db);
    print "<p>Now read on: ";
    print_fanfic($fanfic_id, $db);
    
    print_accessible_location_foot(224, $db);
    
    print_footer(224, $db);
    ?>

</div>
</body>
</html>
