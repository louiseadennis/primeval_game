<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(17, $db);
    
    $char_collected = check_for_character('monty', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
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
<img src=assets/location17.png>
<h2>A Snowy Plain</h2>

<p>You are standing in a snowy plain amid a herd of mammoths.  You can see a glacier in the distance.</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'monty', $db);
        print "<img src=assets/monty.png align=left>";
        print "<p>Monty is here.</p>";
    }
    
    print_footer(17, $db)
    ?>

</div>
</body>
</html>
