<?php 

require_once('./config/accesscontrol.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
require_once('utilities.php');
session_start();
sessionAuthenticate();

$db = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
if ($db -> connect_errno > 0) {
   die('Unable to connect to database [' . $mysql_host . $mysql_user .  $mysql_password . $mysql_database . $db->connect_error . ']');
   }
    
$last_action = mysqlclean($_POST, "last_action", 10, $db);
//    print $last_action;


$travel_type = mysqlclean($_POST, "travel_type", 10, $db);
$prev_location = get_location($db);
$prev_era = get_value_for_location_id("era", $prev_location, $db);
$location_id = mysqlclean($_POST, "location", 10, $db);

if ($last_action == "item" || $last_action == "wait" ) {
    $current_location = get_location($db);
    $action_required = get_value_for_location_id("action_required", $current_location, $db);
    $action_done = get_value_from_users("action_done", $db);
    $item_used = mysqlclean($_POST, "item_used", 10, $db);
    if ($action_required != '' && !$action_done) {
        $item_name = get_value_for_equip_id("name", $item_used, $db);
        if ($item_name !== $action_required) {
            if ($action_required == 'inflatable dinghy') {
              $last_action = "travel";
              $travel_type = "anomaly";
              $location_id = get_value_from_users("prev_location", $db);
              update_users("needed_boat", 1, $db);
            } else if ($action_required == 'breathing aparatus') {
                $hp = get_value_from_users("hp", $db);
                $hp = $hp - 1;
                update_users("hp", $hp, $db);
                $now = now();
                update_users("healing_start", $now, $db);
            }
      } else {
      	update_users("action_done", 1, $db);
      }
   }
}

if ($last_action == "travel") {
   resolve_events($db);
    if ($travel_type != "lof") {
        update_users("anomaly", 0, $db);
    }
    
    if ($travel_type == "vehicle") {
        $cost = travel_cost($prev_location, $location_id, $db);
        $budget_index = get_budget_index($db);
        $uses_list = get_value_from_users("uses", $db);
        $uses_array = explode(",", $uses_list);
        $budget = $uses_array[$budget_index];
        $new_budget = $budget - $cost;
        if ($new_budget < 0) {
            $new_budget = 0;
        }
        $uses_array[$budget_index] = $new_budget;
        $new_uses_list = join(",", $uses_array);
        update_users("uses", $new_uses_list, $db);
    }
}

update_users("last_action", $last_action, $db);

if ($travel_type == "device") {
   $dial1 = mysqlclean($_POST, "dial1", 10, $db);
   $dial2 = mysqlclean($_POST, "dial2", 10, $db);
   $dial3 = mysqlclean($_POST, "dial3", 10, $db);
   $location_id = use_device($dial1, $dial2, $dial3, $db);
}
    
if ($travel_type == "lof") {
    $choice_id = mysqlclean($_POST, "choice_id", 10, $db);
    if ($choice_id == "choice1") {
        $picture = mysqlclean($_POST, "picture", 10, $db);
        if ($picture != "none") {
            update_lof_choice(1, $picture, $prev_location, $db);
        }
    } else if ($choice_id == "choice2") {
        $racoon = mysqlclean($_POST, "racoon", 10, $db);
        if ($racoon != "none") {
            update_lof_choice(2, $racoon, $prev_location, $db);
        }
    } else if ($choice_id == "choice3") {
        $placename = mysqlclean($_POST, "placename", 50, $db);
        if ($placename != "x1x1x1") {
            update_lof_choice(3, $placename, $prev_location, $db);
        }
    } else if ($choice_id == "choice4") {
        $story = mysqlclean($_POST, "story", 100, $db);
        if ($story != "x1x1x1") {
            update_lof_choice(4, $story, $prev_location, $db);
        }
    }
    update_users("c1_prev", 'A', $db);
    $location_id = 1;
    
}
    
    $hp = get_value_from_users("hp", $db);
    if ($hp < 1) {
        $location_id = 224;
    }


    if ($travel_type != '' && $travel_type != "none") {
       update_users("travel_type", $travel_type, $db);
       update_users("action_done", 0, $db);
    } else {
        if ($last_action == "item") {
           $item_used = mysqlclean($_POST, "item_used", 10, $db);
           if ($item_used != '') {
              update_users("item_used", $item_used, $db);
           } else {
              update_users("item_used", 2, $db);
           }
        } else if ($last_action == "purchase") {
            $item_purchased = mysqlclean($_POST, "item_purchased", 10, $db);
            $name = get_value_for_equip_id("name", $item_purchased, $db);
            add_equipment($name, $db);
            $cost = get_value_for_equip_id("cost", $item_purchased, $db);
            $uses_list = get_value_from_users("uses", $db);
            $uses_array = explode(",", $uses_list);
            $budget_index = get_budget_index($db);
            $budget = $uses_array[$budget_index];
            $new_budget = $budget - $cost;
            if ($new_budget < 0) {
                $new_budget = 0;
            }
            $uses_array[$budget_index] = $new_budget;
            $new_uses_list = join(",", $uses_array);
            update_users("uses", $new_uses_list, $db);
        } else if ($last_action == "master") {
            $master = mysqlclean($_POST, "master", 10, $db);
            // print $master;
            if ($master == '1') {
                $sql = "SELECT user_id from users where master = 1";
                if (!$result = $db -> query($sql))
                    showerror($db);
                $masters = $result->num_rows;
                if ($master > 0) {
                    $user_id = get_user_id($db);
                    $sql = "UPDATE users SET master = 0 where user_id = $user_id";
                    if (!$result = $db -> query($sql))
                        showerror($db);
                }
                update_users("master", 1, $db);
            }
        } else if ($last_action == "write") {
            $story = mysqlclean($_POST, "story", 100, $db);
            $sql = "SELECT * FROM locations where location_id={$location_id}";
            if (!$result = $connection->query($sql))
                showerror($connection);
            
            while ($row=$result->fetch_assoc()) {
                $story = $row["story"];
                
                $new_story = $story . "<br>" . $value;
                
                $sql = "UPDATE locations SET story='{$new_story}' WHERE location_id='$location_id'";
                if (!$connection->query($sql)) {
                    showerror($connection);
                }
                return 1;
            }
            return 1;
        }
    }

    $user_id = get_user_id($db);

    if ($location_id=='') {
       header("Location: location1.php");
       exit;
    } else if ($prev_location!=$location_id) {
        if ($prev_era != 'Sanctuary') {
            update_users("prev_location", $prev_location, $db);
        }
       update_location($prev_location, "anomaly", 0, $db);
       update_users("location_id", $location_id, $db);
    }

    $location_string = "location" . $location_id;
    header("Location: $location_string.php");
    exit;
    
?>
<html>
<head>
<title>52 Weeks of Primeval - The Gentlemen of Primeval</title>

<link rel="stylesheet" href="styles/default.css" type="text/css">
</head>
<body>
<div class=main>
<p>This is the main page.  It should not appear</p>
<?php
	echo "<p>$message</p>";
	echo "<p>prev_location:$prev_location</p>";
	echo "<p>location:$location_id</p>";
?>
</body>
</html>
