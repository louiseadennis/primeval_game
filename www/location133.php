<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(133, $db);
    add_equipment("inflatable dinghy",$db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    add_location_clue(133, $db)
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location133.png>
<h2>A lakeside</h2>

<p>You are beside a lake where anomalies have been reported.  The ARC supplies you with an inflatable dinghy.  Someone has graffittied `Should be up an arse' on one of the piers.</p>

<?php
    print_travel(133,$db);
    print_footer(133,$db);
    ?>

</div>
</body>
</html>
