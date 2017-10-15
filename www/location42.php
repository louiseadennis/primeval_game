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

check_location(42, $mysql);

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
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location42.png>
<h2>A Jungle</h2>

<p>You are standing at the edge of a  jungle, looking out over a plain teaming with mammalian life.</p>

<?php
if ($phase > 4) {
   add_location_clue(42, $mysql);
?>
<p>A piece of paper is held pinned to a tree.  It reads:</p>
<center><img src=assets/clue42.png></center><h3>Across</h3><ol><li>Five squared.</li><li>An unhealthy pale complexion.</li><li>The last word.</li></ol><h3>Down</h3><ol><li>The duration of a UK Parliament according to the Fixed Term Parliaments Act 2011.</li><li>Of, relating to, or belonging to oneself or itself.</li></ol>
<?php
}
?>
</div>
</body>
</html>