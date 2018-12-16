<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(18, $db);
    
    $leeds_collected = check_for_character('leeds', $db);
    if (!$leeds_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'leeds') {
            add_location_clue(18, $db);
            add_equipment('throwing screwdriver', $db);
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
<img src=assets/location18.png>
<h2>A Rocky Plain</h2>

<p>You find yourself standing in a rocky plain.  There are graves here, boxes of equipment, and a dead future predator.  One of the boxes has the initial B.N.T. stamped on it.</p>

<?php
    
    if (!$leeds_collected) {
        update_users("new_character", 'leeds', $db);
        print "<img src=assets/leeds.png align=left>";
        print "<p>Leeds is here.  He lets you borrow a screwdriver.</p>";
    }
    
    print_footer(18, $db);
    ?>
</div>
</body>
</html>
