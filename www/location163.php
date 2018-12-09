<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(163, $db);
    
    $char_collected = check_for_character('ross', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'ross') {
            add_location_clue(163, $db);
            add_equipment("hand gun", $db);
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
<img src=assets/location.png>
<h2>Placeholder</h2>

<p>First Letters:</p>

<table>
<tr><td>B</td><td>O</td><td>N</td><td>E</td><td>T</td></tr>
<tr><td>E</td><td>F</td><td>G</td><td>H</td><td>O</td></tr>
<tr><td>D</td><td>O</td><td>P</td><td>I</td><td>O</td></tr>
<tr><td>C</td><td>N</td><td>Q</td><td>J</td><td>T</td></tr>
<tr><td>B</td><td>M</td><td>L</td><td>K</td><td>H</td></tr>
<tr><td>A</td><td>W</td><td>A</td><td>L</td><td>C</td></tr>
</table>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'ross', $db);
        print "<img src=assets/ross.png align=left>";
        print "<p>Ross Jenkins is here.  He has a hand gun.</p>";
    }
    ?>


</div>
</body>
</html>
