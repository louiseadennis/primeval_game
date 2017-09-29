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

check_location(40, $mysql);

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
$evan_collected = check_for_character('evan', $mysql);

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Forest Clearing</h2>

<p>You are standing in a clearing in a forest of seed ferns.  Flying reptiles dart overhead which Stephen identifies as Eudimorphodons.</p>

<?php

if ($phase > 4 && !$evan_collected) {
     update_users("new_character", 'evan', $mysql);
     print "<img src=assets/evan.png align=left>";
     print "<p>Evan is here.  He shares his tranquiliser darts with you.</p>";
     print "<p>Helen left him with a grid of letters:</p>";
     print "<p><table><tr><td>A</td><td>K</td><td>C</td><td>F</td><td>J</td><td>L</td><td>I</td><td>S</td></tr><tr><td>Q</td><td>E</td><td>T</td><td>U</td><td>O</td><td>A</td><td>E</td><td>D</td></tr><tr><td>G</td><td>J</td><td>L</td><td>X</td><td>V</td><td>V</td><td>N</td><td>T</td></tr><tr><td>W</td><td>S</td><td>R</td><td>L</td><td>E</td><td>G</td><td>N</td><td>T</td></tr><tr><td>E</td><td>L</td><td>T</td><td>N</td><td>Y</td><td>O</td><td>E</td><td>D</td></tr><tr><td>D</td><td>Y</td><td>C</td><td>E</td><td>N</td><td>I</td><td>B</td><td>E</td></tr><tr><td>N</td><td>O</td><td>C</td><td>E</td><td>A</td><td>E</td><td>L</td><td>M</td></tr><tr><td>N</td><td>M</td><td>E</td><td>W</td><td>R</td><td>H</td><td>B</td><td>R</td></tr></table></p>";
     add_location_clue(40, $mysql);
     add_equipment('tranquiliser rifle', $mysql);
}

print_equipment($mysql);
?>
</body>
</html>