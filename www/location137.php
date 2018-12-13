<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(137, $db);

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
print_standard_start($db);
?>
<div class=location>
<img src=assets/location137.png>
<h2>A French Farmhouse</h2>

<i><p>"Shoot it!" he yells at Connor.</p>

<p>"What do you think I'm trying to do?! Playing Cowboys and Indians with it?"</p>

<p>"You miss again and we're..."</p>

<p>"Yeah I know, Dino munchies..."</p>

<p>He might have been too hard on Connor but in life or death situations it was kind of hard to stay entirely calm and rational. He tried his best to overcome the thread of panic in his being, knowing that criticism was no good way to handle the resident geek of the team.</p></i>

<?php
    add_fanfic(4, $db);
    print "<p>Now read on: ";    print_fanfic(4, $db);
    ?>

<?php
    print_travel(137, $db);
    print_footer(137, $db);
?>
</div>
</body>
</html>
