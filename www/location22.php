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

check_location(22, $mysql);
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
$becker_collected = check_for_character('becker', $mysql);
if (!$becker_collected) {
     $visited=get_value_from_users("new_character", $mysql);
     if ($visited != 'becker') {
          add_equipment("shotgun", $mysql);
     }
}

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location22.png>
<h2>A Tropical Island</h2>

<p>You are standing on the beach of what feels like a warm tropical island.  Archeopteryx can be seen circling above the tops of the palm-like trees.</p>

<?php

if (!$becker_collected) {
     update_users("new_character", 'becker', $mysql);
     print "<img src=assets/becker.png align=left>";
     print "<p>Becker is here. He says Helen kept telling him about CEO Thing, but he has no idea who that is.  He's quite grumpy about the whole situation and his hair is almost slightly ruffled.</p>";
     add_location_clue(22, $mysql);
}

?>
</div>
</body>
</html>