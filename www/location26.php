<?php 
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!mysql_select_db($mysql_database))
  showerror();

check_location(26, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);

$phase = get_user_phase($mysql);
$danny_collected = check_for_character('danny', $mysql);
if (!$danny_collected) {
     $visited = get_value_from_users("new_character", $mysql);
     if ($visited != 'danny') {
          add_equipment("a big stick", $mysql);
     }
}
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location26.png>
<h2>A Desolate Landscape</h2>

<p>You are standing in a windswept dusty plain.  There is an acrid smell in the air and a yellowish tinge to the atmosphere.</p>

<?php
$action_done = get_value_from_users("action_done", $mysql);
if (!$action_done) {
   print "<p><b>You must use breathing apparatus or you will take damage.</b></p>";
}
?>

<?php

if (!$danny_collected) {
      update_users("new_character", 'danny', $mysql);
     print "<img src=assets/danny.png align=left>";
     print "<p>Danny is here. He says he has been holding future predators off with Molly.  When you asks he says that  Helen didn't say anything to him and he hasn't seen anything that looks like a clue.  He recommends returning to the ARC.</p>";
}
?>
</div>
</body>
</html>