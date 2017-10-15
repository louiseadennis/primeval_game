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

$uname = $_SESSION["loginUsername"];
$location = get_location($mysql);
?>
<html>
<head>
<title>52 Weeks of Primeval - Log Book</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<div class="main">
<p><form method="POST" action="main.php">
<input type="hidden" name="location_id" value="
<?php
echo $location
?>
">
<input type="hidden" name="last_action" value="profile_check">
<input type="submit" value="Back to Game">
</form>
</p>
<h2>Log Book</h2>
<h3>Device Notes</h3>
<?php
$log = get_value_from_users("log", $mysql);
print "<table>";
print "<tr><th>Dial</th><th>Three Way Switch</th>";
$user_phase = get_value_from_users("phase", $mysql);
if ($user_phase > 2) {
   print "<th>Second Switch</th>";
}
print "<th>Notes</th></tr>";
if ($log != '') {
   $log_array = explode(":", $log);
   sort ($log_array);
   $current_dial=500;
   $current_button1=500;
   $current_button2=500;
   foreach ($log_array as $entry) {
      $entry_array = explode(',', $entry);
      $dial = substr($entry_array[0], 1);
      $button1 = $entry_array[1];
      $same_as_previous = 0;
      $phase_text = '';
     if ($button1 == 0) {
      	 $button_p = "A";
      } else if ($button1 == 1) {
      	$button_p = "B";
      } else {
      	$button_p = "C";
      }
      $button2 = $entry_array[2];

      if ($button2 == 0) {
      	 $button2_p = "Off";
      } else {
      	 $button2_p = "On";
      }
      $phase = $entry_array[3];

      if ($current_dial == $dial && $current_button1 == $button1 && $current_button2 == $button2) {
         $same_as_previous = 1;
      } else {
      	  $current_dial = $dial;
	  $current_button1 = $button1;
	  $current_button2 = $button2;
      } 
      $location_id = get_location_from_coords((int)$dial, (int)$button1, (int)$button2, $mysql);
      if ($user_phase == 2) {
            $phase_text = get_value_for_location_id("static_text_p2", $location_id, $mysql);
      }

      if ($user_phase == 3) {
            $phase_text = get_value_for_location_id("static_text_p3", $location_id, $mysql);
      }

      if ($user_phase == 4) {
            $phase_text = get_value_for_location_id("static_text_p4", $location_id, $mysql);
      }

      if ($user_phase == 5) {
            $phase_text = get_value_for_location_id("static_text_p5", $location_id, $mysql);
      }

      if ((is_null($phase_text) || $phase_text == '') & $same_as_previous != 1) {
            $phase_text = get_value_for_location_id("static_text_p1", $location_id, $mysql);
      } else if ($same_as_previous != 1) {
            $initial_phase_text = get_value_for_location_id("static_text_p1", $location_id, $mysql);
      	    $phase_text = $initial_phase_text . "  " . $phase_text;
      }

      if (!is_null($phase_text) && $phase_text != '') {
            print "<tr><td>$dial</td><td>$button_p</td>";
      	    if ($user_phase > 2) {
      	       print "<td>$button2_p</td>";
      	    }

      	    print "<td>$phase_text</td></tr>";
      }
   }
}
print "</table>";

print "<h3>Clues</h3>";
$clues = get_value_from_users("locationclues", $mysql);
if (!is_null($clues)) {
   $clue_array = explode(",", $clues);
   print "<ul>";
   foreach ($clue_array as $clue_id) {
   	   $clue = get_value_for_location_id("clue", $clue_id, $mysql);
	   print "<li>$clue</li>";
   }
   print "</ul>";
}



?>
<p><form method="POST" action="main.php">
<input type="hidden" name="location_id" value="
<?php
echo $location
?>
">
<input type="hidden" name="last_action" value="profile_check">
<input type="submit" value="Back to Game">
</form>
</p>
</div>
</body>
</head>
</html>
