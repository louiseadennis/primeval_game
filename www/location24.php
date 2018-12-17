<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(24, $db);
    add_location_clue(24, $db);
    
    $hp = get_value_from_users("hp", $db);
    $new_hp = $hp - 1;
    
    update_users("hp", $new_hp, $db);

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
<img src=assets/location24.png>
<h2>A Frozen Landscape</h2>

<p>You are standing in a frozen landscape and the air is hard to breathe.  <b>You can not survive here long.</b>  Carved into the ice are the words: "Protest against Nuclear Weapons"</p>

<?php
    print_footer(24,$db);
    ?>
</div>
</body>
</html>
