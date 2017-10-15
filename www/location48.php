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

check_location(48, $mysql);

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
$leeds_collected = check_for_character('leeds', $mysql);
if ($phase > 4 && !$leeds_collected) {
     $visited_already = get_value_from_users("new_character", $mysql);
     if ($visited_already != 'leeds') {
     	   add_equipment('throwing screwdriver', $mysql);
     }
}
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location48.png>
<h2>The Edge of a Forest</h2>

<p>You are standing at the edge of a lush forest overlooking a vast plain.  In the distance you can see massive sauropod dinosaurs grazing on the vegetation.</p>

<?php

if ($phase > 4 && !$leeds_collected) {
     update_users("new_character", 'leeds', $mysql);
     print "<img src=assets/leeds.png align=left>";
     print "<p>Leeds is here.  He lets you borrow a screwdriver.</p>";
     print "<p>Leeds says that Helen left him with no clues to further locations.  However he is fairly sure that Colonel Hall and Major Douglas were both kidnapped from Project Magnet at the same time as he was.  If you haven't found them already it may be necessary to perform an exhaustive search of the locations in the device.</p>";
     
}

?>
</div>
</body>
</html>