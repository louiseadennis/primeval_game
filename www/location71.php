<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(71, $db);

    $char_collected = check_for_character('ditzy', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'ditzy') {
            add_location_clue(71, $db);
            add_equipment("first aid kit", $db);
        }
    }?>
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
<img src=assets/location71.png>
<h2>A Stately Home</h2>

<p>You are standing outside an impresive stately home that is used as a Wedding Venue.  A glossy leaflet stand is set up in the entrance but strangely the only leaflet is a flyer that says:  My first is five.  Add one and multiply by three for my second.  Divide by six for my third.</p>
<?php
    
    if (!$char_collected) {
        update_users("new_character", 'ditzy', $db);
        print "<img src=assets/ditzy.png align=left>";
        print "<p>Ditzy is here.  He has a first aid kit.</p>";
    }
    print_travel(8, $db);
    print_footer(17, $db);
    
    ?>
</div>
</body>
</html>
