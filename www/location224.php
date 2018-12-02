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
?>
<div class=location>
<img src=assets/location224.jpg>
<h2>Sanctuary</h2>

<i><p>The smilodon padded in front of the door, blocking Stephen's view of Nick's appalled gaze. Stephen focused on the ripple of muscle beneath the thick, sandy fur in a vain attempt to distract himself from the scrape of claws on concrete behind him, and the movements above him at the edge of his field of vision. Not that he need concern himself with the future predators - he'd be dead long before they would bother to join in.</p>

<p>The smilodon was turning towards him now, moving into a crouch, preparing to spring. An odd kind of calm descended over Stephen, although he could still feel the thump of his racing heartbeat. There was nothing more he could do. It would soon be over.</p>

<p>He closed his eyes and waited.</p>

<p>The thump knocked all the breath from him, the collision sending him flying through the air, gasping in a desperate bid for oxygen as consciousness left him ...</p>

<p>...</p>

<p>"I wondered when you'd turn up."</p></i>

<?php
    add_fanfic(2, $db);
    print "<p>Now read on:";    print_fanfic(2, $db);
    ?>

</div>
</body>
</html>
