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

check_location(30, $mysql);

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
add_location_clue(30, $mysql);

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Forest Stream</h2>

<p>You are standing by a stream through a forest of seed ferns.  A piece of paper has been left on a rock.  It reads:</p>

<ul><li>0: Pre-Cambrain and Cambrian</li><li>1: Silurian/Devonian/Ordovician</li><li>2: Carboniferous</li><li>3: Permian</li><li>4: Triassic</li><li>5: Jurassic</li><li>6: Cretaceous</li><li>7: Pleistocene/Pliocene</li><li>8: Holocene</li><li>9: Post-Holocene</li></ul>

<?php

print_equipment($mysql);
?>
</body>
</html>