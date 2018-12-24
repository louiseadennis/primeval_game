<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(108, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    add_location_clue(108, $db);
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location108.png>
<h2>A Jungle</h2>

<p>You are standing at the edge of a  jungle, looking out over a plain teaming with mammalian life.  A piece of paper is pinned to a tree.  It reads: 101 Emperors (of the Roman Kind)</p>

<?php
    print_footer(108,$db);
    ?>

</div>
</body>
</html>
