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

check_location(27, $mysql);

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
print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Freshwater Lake</h2>

<p>You in the middle of a freshwater lake.  You can see huge trees lining the shores of the lake.  The air is warm and humid.  You will need a boat otherwise you will be swept out of the anomaly again!</p>

<?php
   print_equipment($mysql);
?>
</body>
</html>