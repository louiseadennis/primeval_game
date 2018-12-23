<?php

    require_once('./config/accesscontrol.php');
    require_once('./utilities.php');

    // Set up/check session and get database password etc.
    require_once('./config/MySQL.php');
    session_start();
    sessionAuthenticate();

    $db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
    check_location(1, $db);

// $phase = get_user_phase($db);
    $d100_roll = rand(1, 100);

?>
<html>
<head>
<title>12 Months of Primeval Denial - The ARC</title>

<link rel="stylesheet" href="./styles/default.css?v=12" type="text/css">

</head>
<body>
<?php
    print_header($db);
    $has_device = get_value_from_users("has_device", $db);
    if (!$has_device) {
        add_equipment('EMD', $db);
    }
    add_location_clue(1, $db);
    update_users("has_device", 1, $db);
    update_users("random_anomalies", 1, $db);
    print_standard_start($db);
?>
<div class=main>

<?php

    $lester_collected = check_for_character('lester', $db);
    if ($lester_collected) {
        $lester_recharges = 0;
        if ($has_device) {
            $lr = default_lester_recharges();
            if ($d100_roll < $lr) {
                $equip_list = get_value_from_users("equipment", $db);
                $equip_id_array = explode(",", $equip_list);
                $random = rand(0, count($equip_id_array) - 1);
                $name = get_value_for_equip_id("name", $equip_id_array[$random], $db);
                add_equipment($name, $db);
                $default_uses = get_value_for_equip_id("default_uses", $equip_id_array[$random], $db);
                $lester_recharges = 1;
            }
        }
    }
?>
<div class=location>
<img src=assets/location1.png>
<h2>The ARC</h2>

<p>You are in the ARC.  It is empty of people.  On one of the consoles is pinned a  handwritten note which says:</p>

<p><i>To find your friends.  Follow the clues.  Here are five clues to get you started:
<ol>
<li>Major Operating System in the 1980s and early 1990s.</li>
<li>You should revERSe.</li>
<li>The Democratic Republic of Congo.</li>
<li><img src=assets/clue1.png></li>
<li>Set the dials on the device to A, N, E and activate it.</li>
</ol>
</i></p>
<?php
    $location_count = get_value_from_users("location_count", $db);
    if ($location_count > 5) {
        update_users("location_count", 0, $db);
        add_equipment("budget", $db);
        print "<p>Your budget is renewed.</p>";
    }

    
    if ($lester_recharges && $default_uses < 500) {
        $sql = "SELECT * FROM characters;";
        if (!$result = $db->query($sql))
            showerror($db);
        $total = $result->num_rows;
        $char_id_list = get_value_from_users("char_id_list", $db);
        $char_id_array = explode(",", $char_id_list);
        if ($char_id_array->count == $total && !check_for_equipment("tank", $db)) {
            print "<p>Lester congratulates you on finding everyone.  He resupplies your $name and agrees to buy a tank.</p>";
            add_equipment('tank', $db);
        } else {
            print "<p>Lester agrees to resupply your $name.  He refuses to buy a tank.</p>";
        }
    }

    print_travel(1, $db);
    print_equipment_purchase($db);
    
    print_footer(1, $db);
?>
</div>
</body>
</html>
