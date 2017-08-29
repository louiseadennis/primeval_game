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

check_location(2, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header();
print_device($mysql);
print_anomaly($mysql);
?>
<div class=main>
<h2>Somewhere</h2>

<p>Somewhere description</o>
<?php
$phase = get_user_phase($mysql);

if ($phase == 1) {
   if (!check_for_character('stephen', $mysql)) {
      print "<img src=assets/stephen.png align=left>";
      print "<p>Stephen is here.</p>";

      print "<p>He is holding a strange device which, he claims, Helen left him with.  It has a dial, a toggle switch and an activate button.  Stephen says Helen told him to  select X on the dial and Y on the switch.  He had been about to try it when you arrived.</p>";
   }
} else {
?>
<p>Other Phase Message</p>
<?php
}
?>
</body>
</html>