<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(5, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    add_location_clue(5, $db);
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location5.png>
<h2>The British Museum</h2>

<p>At the desk of the British Museum, you are handed a note: For those who are reading this.  Often have I seen you.  Time and time again.</p>

<?php
    
    print_travel(5, $db);
    print_footer(5, $db);
    ?>

</div>
</body>
</html>
