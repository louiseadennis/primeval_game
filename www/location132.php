<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(132, $db);
    add_location_clue(132,$db);

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
print_critter_trail_start(2, $db);
?>
<div class=location>
<img src=assets/location132.png>
<h2>The Sea near a Sandy Shore</h2>

<p>As he swam through the water, Lester stared around seeking any sort of clue to where they might be, although without Connor’s knowledge of past times his chances of identifying anything had to be close to non-existent. He’d spent time – as the soldiers had – in listening to Cutter’s lectures on the subject as often as possible, under the guise of checking their usefulness, when in reality he had actually wanted to know as much as possible about the challenges his team had to face. But it was hard to translate that knowledge into what he now saw around him.</p>

<p>Below him, Lester could make out pale sand, rolled into gentle ripples by the water. Everywhere he looked he could see clumps of wispy green weed and an abundance of brightly-coloured corals clinging to scattered rocks. Something that looked like a large, flat horseshoe with a whip-like tail scooted away underneath him, skimming lightly over the sand and leaving a faint trail behind in its wake. Lester was suddenly aware of the fact that the water around him was teeming with life, but nothing seemed large enough to be threatening, although as soon as that thought crossed his mind an uncomfortable image of piranha fish chose that moment to intrude and remind him that size wasn’t the only indicator of threat levels.</p>


<p>A wooden plank is floating near you with the words `Equally Divided Clothed'</p>

<?php
    add_fanfic(38, $db);
    print "<p>Now read on: ";
    print_fanfic(38, $db);
    
    $action_done = get_value_from_users("action_done", $db);
    if (!$action_done) {
        print "<p><b>You will need a boat otherwise you will be swept out of the anomaly again!</b></p>";
    }
print_footer(132, $db);
?>
</div>
</body>
</html>
