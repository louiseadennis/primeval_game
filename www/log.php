<?php 

require_once('./config/accesscontrol.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
require_once('utilities.php');
session_start();
sessionAuthenticate();

$db = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);

$uname = $_SESSION["loginUsername"];
$location = get_location($db);
?>
<html>
<head>
<title>12 Months of Primeval Denial - Log Book</title>

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
$log = get_value_from_users("log", $db);
print "<table>";
print "<tr><th>Key</th><th>Notes</th></tr>";
if ($log != '') {
   $log_array = explode(":", $log);
   sort ($log_array);
   $current_button1="Z";
   $current_button2="Z";
   $current_button3="Z";
   foreach ($log_array as $entry) {
      $entry_array = explode(',', $entry);
      $button1 = substr($entry_array[0], 1);
      $button2 = $entry_array[1];
      $button3 = substr($entry_array[2], 0, -1);
      $same_as_previous = 0;
      $text = '';

      if ($current_button1 == $button1 && $current_button2 == $button2 && $current_button3 == $button3) {
         $same_as_previous = 1;
      } else {
          $current_button1 = $button1;
          $current_button2 = $button2;
          $current_button3 = $button3;
      } 
      $location_id = get_location_from_coords($button1, $button2, $button3, $db);

      $text = get_value_for_location_id("text", $location_id, $db);

       print "<td>$current_button1, $current_button2, $current_button3</td>";
      print "<td>$text</td></tr>";
   }
}
print "</table>";

print "<h3>Clues</h3>";
$clues = get_value_from_users("locationclues", $db);
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
