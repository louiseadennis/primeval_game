<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(166, $db);

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
print_leek_start($db);
?>
<div class=location>
<img src=assets/location166.png>
<h2>A Warehouse</h2>

<?php
    print "<p>You are in Leek's Warehouse.</p>";

    $critter_number = get_value_from_users("leek_critter", $db);
    $critter_hp = get_value_from_users("leek_critter_hp", $db);
    if (!is_null($critter_hp) & $critter_hp <= 0) {
        $critter_number = $critter_number + 1;
        update_users("leek_critter", $critter_number, $db);
    }

    if ($critter_number == 1) {
        print "<p>There are a number of creatures loose in here.</p>";
        $critter_id = 4;
        if (is_null($critter_hp)) {
            $critter_hp = get_value_for_critter_id("hp", $critter_id, $db);
            update_users("leek_critter_hp", $critter_hp, $db);
        }
        print "<p>You see a Smilodon.  <b>It is about to attack.</b></p>";
    } else if ($critter_number == 2) {
        print "<p>There are a number of creatures loose in here.</p>";
        $critter_id = 5;
        if ($critter_hp < 0) {
            $critter_hp = get_value_for_critter_id("hp", $critter_id, $db);
            update_users("leek_critter_hp", $critter_hp, $db);
        }
        print "<p>You see a Scutosaurus. <b>It is about to attack.</b></p>";
    } else if ($critter_number == 3) {
        print "<p>There are a number of creatures loose in here.</p>";
        $critter_id = 1;
        if ($critter_hp < 0) {
            $critter_hp = get_value_for_critter_id("hp", $critter_id, $db);
            update_users("leek_critter_hp", $critter_hp, $db);
        }
        print "<p>You see a Future Predator.  <b>It is about to attack.</b></p>";
        
    }
    
    print_travel(166, $db);

    ?>

</div>
</body>
</html>
