<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(94, $db);

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
<img src=assets/location94.png>
<h2>An Estuary</h2>

<p>You are on the banks of a wide estuary that flows into the sea.  Mosses and ferns surround you, none growing very high.  In the water of the river, amonites can  be seen.</p>

<?php
    print_footer(94,$db);
    ?>

</div>
</body>
</html>
