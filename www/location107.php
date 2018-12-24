<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(107, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $evan_collected = check_for_character('evan', $db);

    if (!$evan_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'evan') {
            add_equipment('tranquiliser rifle', $db);
        }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location107.png>
<h2>Hiding from a Giganatosaurus.</h2>

<p>You are deep within the primeval forest, hiding from a Giganatosaurus.</p>

<?php
    
    if (!$evan_collected) {
        update_users("new_character", 'evan', $db);
        print "<img src=assets/evan.png align=left>";
        print "<p>Evan is here.  He shares his tranquiliser darts with you and a strange list of pre-historic creatures: Andrewsarchus, Brontisaur, Ichthyosaur, Pachykefalosaurus, Gorgonopsid.</p>";
        add_location_clue(107, $db);
    }
    
    print_footer(107,$db);
    ?>


</div>
</body>
</html>
