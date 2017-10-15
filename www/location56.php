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

check_location(56, $mysql);

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
$duncan_collected = check_for_character('duncan', $mysql);

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location56.png>
<h2>An Aiport</h2>

<p>This is a private airport.  It seems to be largely deserted, though there is a plane parked up.</p>

<?php

if (!$duncan_collected) {
     update_users("new_character", "duncan", $mysql);
     print "<img src=assets/duncan.png align=left>";
     print "<p>Duncan is here investigating rumours of anomalies.</p>";
}

print "<p>From here you can get by conventional transport to:<ul>";
$accessible = get_present_day_locations($mysql);
foreach ($accessible as $by_car) {
    if ($by_car != 56 && ($phase > 1 || $by_car != 19)) {
      print "<li>";
      print_accessible_location($by_car, $mysql);
      print "</li>";
    }
}
print "</ul></p>";
?>
</div>
</body>
</html>