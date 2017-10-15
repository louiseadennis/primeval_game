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

check_location(29, $mysql);

$phase = get_user_phase($mysql);
?>
<html>
<head>
<title>52 Weeks of Primeval - Leek's Warehouse</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);
print_standard_start($mysql);
?>
<div class=main>
<div class=location>
<img src=assets/location29.png>
<h2>The Forest of Dean</h2>
<?php

if ($phase == 4) {
?>
    <p>The soldiers stationed in the Forest of Dean to watch for anomalies report that a new one opened recently and they think they saw Helen going through it.  They point it out to you:</p>

<?php
     anomaly(31);
} else {
    print "<p>You are standing in the Forest of Dean near the site of the original anomaly.  The ARC maintains a permanent presence here because of the large number of anomalies.</p>";

}

print "<p>From here you can get by conventional transport to:<ul>";
$accessible = get_present_day_locations($mysql);
foreach ($accessible as $by_car) {
    if ($by_car != 29 && ($phase > 1 || $by_car != 19)) {
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