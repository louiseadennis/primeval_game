<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(217, $db);

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
<img src=assets/location.png>
<h2>A White Void</h2>

<p>Whiteness surrounds you in all directions.</p>

<?php
    print "<p>You seem to have no option but to walk<ul>";
    print "<li>";
    print_accessible_location_foot(218, $db);
    print "</li><li>";
    print_accessible_location_foot(219, $db);
    print "</li><li>";
    print_accessible_location_foot(220, $db);
    print "</li><li>";
    print_accessible_location_foot(221, $db);
    print "</li><li>";
    print_accessible_location_foot(222, $db);
    print "</li><li>";
    print_accessible_location_foot(223, $db);
    print "</li>";
    print "</ul></p>";
    
?>
</div>
</body>
</html>
