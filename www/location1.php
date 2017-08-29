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

check_location(1, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval - The ARC</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header();
print_device($mysql);
?>
<div class=main>
<h2>The ARC</h2>
<?php
$phase = get_user_phase($mysql);

if ($phase == 1) {
?>
<p>You find yourself in the ARC.  Pinned to the nearest console is a note:</p>

<p><i>I have kidnapped all the men I could find in this building and scattered them through time.  I challenge you to recover them!</i></p>
<p><i>Helen</i></p>
<?php
	anomaly(2);

} else {
?>
<p>Other Phase Message</p>
<?php
}
?>
</body>
</html>