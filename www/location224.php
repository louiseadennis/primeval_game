<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(224, $db);

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
    if ($sanctuary_visits > 1) {
        $fanfic_id = get_value_for_sanctuary_id("fanfic_id", 2, $db);
    }
    
    ?>
<div class=location>
<img src=assets/location224.jpg>
<h2>Sanctuary</h2>

<?php
    if ($sanctuary_visits > 1) {
        print "<i><p>\"Ow.\"</p>";
        
        print "<p>\"Stephen?\"</p>";
        
        print "<p>\"Ouch ... ow ... bugger!\"</p>";
        
        print "<p>\"What are you doing in there?\"</p>";
        
        print "<p>\"Aarrhh ...\"</p>";
        
        print "<p>\"Stephen, are you going to open this door or am I going to have to break it down?\"</p>";
        
        print "<p>\"All right, all right, keep your hair on.\"</p>";
        
        print "<p>\"What's the matter?\"</p>";
        
        print "<p>\"It's your bloody kinks, that's what's the matter.\"</p>";
        
        print "<p>\"What?\"</p>";
        
        print "<p>\"Apparently, you now have a piercing kink.\"</p>";
        
        print "<p>\"What do you mean, I have a piercing kink ... holy shit!?!\"</p></i>";
    } else {

        print "<i><p>The smilodon padded in front of the door, blocking Stephen's view of Nick's appalled gaze. Stephen focused on the ripple of muscle beneath the thick, sandy fur in a vain attempt to distract himself from the scrape of claws on concrete behind him, and the movements above him at the edge of his field of vision. Not that he need concern himself with the future predators - he'd be dead long before they would bother to join in.</p>";

        print "<p>The smilodon was turning towards him now, moving into a crouch, preparing to spring. An odd kind of calm descended over Stephen, although he could still feel the thump of his racing heartbeat. There was nothing more he could do. It would soon be over.</p>";

        print "<p>He closed his eyes and waited.</p>";

        print  "<p>The thump knocked all the breath from him, the collision sending him flying through the air, gasping in a desperate bid for oxygen as consciousness left him ...</p>";

        print "<p>...</p>";

        print "<p>\"I wondered when you'd turn up.\"</p></i>";
    }

    add_fanfic($fanfic_id, $db);
    print "<p>Now read on: ";
    print_fanfic($fanfic_id, $db);
    
    if ($sanctuary_visits > 2) {
        print "<p>From here you can get to:";
        print_accessible_location_foot(226, $db);
    }
    
    print_footer(226, $db);
    ?>

</div>
</body>
</html>
