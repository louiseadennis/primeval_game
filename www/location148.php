<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(148, $db);

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
<img src=assets/location148.png>
<h2>Central Metropolitan University</h2>

<p>Teaming with students and secret home of an alternative universe</p>

<?php
    add_fanfic(59,$db);
    print "<p>University AU is here:";
    print_fanfic(59,$db);
print_footer(148, $db);
?>
</div>
</body>
</html>
