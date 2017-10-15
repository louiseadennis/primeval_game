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
<title>52 Weeks of Primeval -
<?php
echo $uname;
?>
 Profile</title>

<link rel="stylesheet" href="./styles/default.css?v=1" type="text/css">
</head>
<body>
<div class=main>
<dl>
<dt>Username:</dt>
<dd>
<?php
echo $uname;
?>
</dd>
</dl>
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

<?php
$char_id_list = get_value_from_users("char_id_list", $mysql);
if ($char_id_list != '') {
   print "<h2>Characters</h2>";
   print "<table>";
   $char_id_array = explode(",", $char_id_list);
   $i = 0;
   foreach ($char_id_array as $char_id) {
      $char_name = get_value_for_char_id("name", $char_id, $mysql);
      $uchar = ucfirst($char_name);
      if ($i == 0) {
      	 print "<tr>";
      }
      $no_space_char_name = str_replace(" ", "_", $char_name);
      print "<td><img src=assets/$no_space_char_name.png></td><td>$uchar</td>";
      if ($i == 5) {
      	 print "</tr>";
	 $i = 0;
      } else {
      	$i = $i + 1;
      }
   }
   print "</table>";
}

print "<h2>Creatures Encountered</h2>";
print "<p>Hover over a square for a clue where to find the critter.</p>";
$critter_id_list = get_value_from_users("critter_id_list", $mysql);
$critter_id_array = explode(",", $critter_id_list);
print "<table>";
$i = 0;
$j = 1;
while ($j <= critter_number($mysql)) {
    if ($i == 0) {
    	 print "<tr>";
    }
    if (in_array($j, $critter_id_array)) {
        $icon = get_value_for_critter_id("icon", $j, $mysql);
    } else {
        $icon = 'assets/unknown_critter.png';
    }
    $era = get_value_for_critter_id("era", $j, $mysql);

    if (!is_null($icon)) {
        print "<td><img src=$icon title=\"$era\"></td>";
    } else {
        $critter_name = get_value_for_critter_id("name", $j, $mysql);
	print "<td>$critter_name<br>Sorry no icon!</td>";
    }
    if ($i == 7) {
    	 print "</tr>";
         $i = 0;
      } else {
      	$i = $i + 1;
     }
   $j++;
}
print "</table>";


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
</body>
</head>
</html>
