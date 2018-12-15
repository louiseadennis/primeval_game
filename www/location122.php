<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(122, $db);

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
<img src=assets/location122.png>
<h2>A Cave halfway up a Cliff Face</h2>

<p><i>He pointed out of the tree at a rocky outcropping that ran out of the forest and along the edge of the plain as a bluff maybe thirty or forty feet high. Not far from the forest, there seemed to be a, not quite a cave exactly, but a hollow in the rock. </i></p>

<?php
    add_fanfic(9, $db);
    print "To find  out more: ";
    print_fanfic(9, $db);

print_footer(122, $db);
?>
</div>
</body>
</html>
