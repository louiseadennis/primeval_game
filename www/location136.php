<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(136, $db);
    
    $duncan_collected = check_for_character('duncan', $db);

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
<img src=assets/location136.png>
<h2>The Docks</h2>

<p>You find yourself amid a host of containers at the docks.</p>

<?php
    
    if (!$duncan_collected) {
        update_users("new_character", "duncan", $db);
        print "<img src=assets/duncan.png align=left>";
        print "<p>Duncan is here investigating rumours of anomalies.</p>";
    }
    
    print_travel(136, $db);
print_footer(136, $db);
?>
</div>
</body>
</html>
