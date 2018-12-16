<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(84, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $connor_collected = check_for_character('connor', $db);
    if (!$connor_collected) {
        $visited = get_value_from_users("new_character", $db);
        if ($visted != 'connor') {
            add_equipment('ADD', $db);
        }
    }
?>
<div class=main>
<?php
 print_standard_start($db);
?>
<div class=location>
<img src=assets/location84.png>
<h2>A Cave in Gwinthin Vale</h2>

<p>The ground was uneven, the rock walls narrowing and widening randomly, forcing him to squeeze in some places, while in others he couldn’t touch both sides at the same time with outstretched hands. The ground started to slope steeply downwards, and abruptly became wetter and muddier.</p>

<?php
    add_fanfic(15, $db);
    print "<p>Now read on: ";    print_fanfic(15, $db);
    ?>

<p>Into the rock has been carved the letters:

<p><table>
<tr><td>T</td><td>T</td><td>T</td></tr>
<tr><td>T</td><td>F</td><td>F</td></tr>
<tr><td>F</td><td>T</td><td>F</td></tr>
<tr><td>F</td><td>F</td><td>F</td></tr>
</table>
</p>
<?php
    
    if (!$connor_collected) {
        update_users("new_character", 'connor', $db);
        print "<img src=assets/connor.png align=left>";
        print "<p>Connor is here.  He has an anomaly detection device.</p>";
        add_location_clue(84, $db);
    }
    
    print_travel(84, $db);
    print_footer(84, $db);
?>
</div>
</body>
</html>
