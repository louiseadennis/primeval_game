<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(153, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    add_location_clue(153, $db);
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location.png>
<h2>Placeholder</h2>

<table>
<tr><td>A</td><td>B</td><td>B</td><td>Y</td><td>C</td></tr>
<tr><td>D</td><td>U</td><td>E</td><td>F</td><td>G</td></tr>
<tr><td>H</td><td>R</td><td>I</td><td>J</td><td>K</td></tr>
<tr><td>L</td><td>T</td><td>M</td><td>A</td><td>N</td></tr>
<tr><td>O</td><td>O</td><td>P</td><td>R</td><td>Q</td></tr>
<tr><td>R</td><td>N</td><td>I</td><td>C</td><td>K</td></tr>
</table>
</div>
</body>
</html>
