<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(129, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($db);
    $ange_collected = check_for_character('ange', $db);
    if ($ange_collected) {

        $ange_recharges = 0;
    
        $d100_roll = rand(1, 100);
        if ($d100_roll < default_lester_recharges()) {
            $equip_list = get_value_from_users("equipment", $db);
            $equip_id_array = explode(",", $equip_list);
            $random = rand(0, count($equip_id_array) - 1);
            $name = get_value_for_equip_id("name", $equip_id_array[$random], $db);
            add_equipment($name, $db);
            $default_uses = get_value_for_equip_id("default_uses", $equip_id_array[$random], $db);
            $ange_recharges = 1;
        }
    }
    
    
    ?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location129.png>
<h2>Cross Photonics</h2>

<p>You are at Cross Photonics in Canada.</p>


<?php
    if ($ange_recharges && $default_uses < 500) {
        print "<p>Ange Finch agrees to resupply your $name.</p>";
    }
    
    print_travel(129, $db);
    print_equipment_purchase($db);
    ?>


</div>
</body>
</html>
