<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(195, $db);
    add_location_clue(195,$db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($db);
?>
<div class=main>
<?php
print_critter_trail_start(39,$db);
?>
<div class=location>
<img src=assets/location195.png>
<h2>A Canadian Tire Store</h2>

<p>A large shop selling auto parts.  A strange poster stuck in the window reads: `A Palindrome of Vowels: a middle'.</p>

<?php
    print_travel(195, $db);
print_footer(195, $db);
?>
</div>
</body>
</html>
