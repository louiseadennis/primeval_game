<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(202, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $lester_collected = check_for_character('lester', $db);
    if (!$lester_collected) {
        add_location_clue(202, $db);
        $visited = get_value_from_users("new_character", $db);
        if ($visited != 'lester') {
            add_equipment("budget", $db);
        }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location202.png>
<h2>A Forest Stream</h2>

<p>You are standing by a stream through a forest of seed ferns.  A piece of paper has been left on a rock.  It reads:
<center><img src="assets/clue202.jpg" width=200></center></p>
<?php
    
    if (!$lester_collected) {
        update_users("new_character", 'lester', $db);
        print "<img src=assets/lester.png align=left>";
        print "<p>Lester is here.  He brushes the lapels of his suit when he sees you and agrees to review your budget.</p>";
    }
?>
</div>
</body>
</html>
