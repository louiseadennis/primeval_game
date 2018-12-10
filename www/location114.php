<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(114, $db);
    
    $char_collected = check_for_character('caroline', $db);
    if (!$char_collected) {
        $visited_already = get_value_from_users("new_character", $db);
        if ($visited_already != 'caroline') {
            add_location_clue(114, $db);
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

<p>Be a Entrepeneur or Elf or Engineer</p>

<?php
    
    if (!$char_collected) {
        update_users("new_character", 'caroline', $db);
        print "<img src=assets/caroline.png align=left>";
        print "<p>Caroline is here.</p>";
    }
    ?>


</div>
</body>
</html>
