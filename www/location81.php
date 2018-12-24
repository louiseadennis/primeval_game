<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(81, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $lorraine_collected = check_for_character('lorraine',$db);
    if (!$lorraine_collected) {
        $visited = get_value_from_users("new_character", $db);
        if ($visited != 'lorraine') {
            add_equipment("budget", $db);
         }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location81.png>
<h2>The London Underground</h2>

<p>You are standing in a London Underground tunnel.</p>

<?php
    if (!$lorraine_collected) {
        update_users("new_character", 'lorraine', $db);
        print "<img src=assets/lorraine.png align=left>";
        print "<p>Lorraine is here.  She says you should go back to the ARC.</p>";
    }
    print_footer(81,$db);
?>
</div>
</body>
</html>
