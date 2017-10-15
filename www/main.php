<?php 

require_once('./config/accesscontrol.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
require_once('utilities.php');
session_start();
sessionAuthenticate();

$mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!mysql_select_db($mysql_database))
  showerror();

$last_action = mysqlclean($_POST, "last_action", 10, $mysql);


$travel_type = mysqlclean($_POST, "travel_type", 10, $mysql);
$prev_location = get_location($mysql);
$location_id = mysqlclean($_POST, "location", 10, $mysql);

if ($last_action == "item" || $last_action == "wait") {
   $current_location = get_location($mysql);
   $action_required = get_value_for_location_id("action_required", $current_location, $mysql);
   $action_done = get_value_from_users("action_done", $mysql);
   $item_used = mysqlclean($_POST, "item_used", 10, $mysql);
   if ($action_required != '' && !$action_done) {
       $item_name = get_value_for_equip_id("name", $item_used, $mysql);
       if ($item_name !== $action_required) {
       	  if ($action_required == 'inflatable dinghy') {
	      $last_action = "travel";
	      $travel_type = "anomaly";
	      $location_id = get_value_from_users("prev_location", $mysql);
	      update_users("needed_boat", 1, $mysql);
          } else if ($action_required == 'breathing aparatus') {
	    $hp = get_value_from_users("hp", $mysql);
	    $hp = $hp - 1;
	    update_users("hp", $hp, $mysql);
	    $now = now();
      	    update_users("healing_start", $now, $mysql);
	  }
      } else {
      	update_users("action_done", 1, $mysql);
      }
   }
}

if ($last_action == "travel") {
   resolve_events($mysql);
   update_users("anomaly", 0, $mysql);
}

update_users("last_action", $last_action, $mysql);

if ($travel_type == "device") {
   $dial = mysqlclean($_POST, "dial", 10, $mysql);
   $button1 = mysqlclean($_POST, "button1", 10, $mysql);
   $button2 =$_POST["button2"];
   $location_id = use_device($dial, $button1, $button2, $mysql);
}


if ($travel_type != '' && $travel_type != "none") {
   update_users("travel_type", $travel_type, $mysql);
   update_users("action_done", 0, $mysql);
} else {
   $item_used = mysqlclean($_POST, "item_used", 10, $mysql);
   if ($item_used != '') {
      update_users("item_used", $item_used, $mysql);
   } else {
      update_users("item_used", 2, $mysql);
   }
}

$user_id = get_user_id($mysql);

if ($location_id=='') {
   header("Location: location1.php");
   exit;
} else if ($prev_location!=$location_id) {
   update_users("prev_location", $prev_location, $mysql);
   update_location($prev_location, "anomaly", 0, $mysql);
   update_users("location_id", $location_id, $mysql);
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