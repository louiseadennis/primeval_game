<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(86, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $nick_collected = check_for_character('nick', $db);
    if (!$nick_collected) {
        add_location_clue(86, $db);
        $visited = get_value_from_users("new_character", $db);
        if ($visited != 'nick') {
            add_fanfic(1, $db);
            // maybe do something?
        }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location.png>
<h2>Placeholder</h2>

<?php
    if (!$nick_collected) {
        update_users("new_character", 'nick', $db);
        print "<img src=assets/nick.png align=left>";
        print "<p>Nick is holding a piece of paper and looking horrified.</p><p>\"I was told this was a clue,\" he says, \"what is it?!?!?\"</p>";
        print "<p>You examine the paper it is ";
        print_fanfic(1, $db);
    }
?>

</div>
</body>
</html>
