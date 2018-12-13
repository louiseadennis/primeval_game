<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(118, $db);
    
    $pups_collected = check_for_character('alex Kay and Marcus', $db);

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
<img src=assets/location118.png>
<h2>Savannah</h2>

<p>You are standing in a grassy savannah among a tribe of neanderthals and their dogs.</p>

<?php
if (!$pups_collected) {
    update_users("new_character", "alex Kay and Marcus", $db);
    print "<img src=assets/alex_Kay_and_Marcus.png align=left>";
    print "<p>Alex, Kay and Marcus are here.  They come running eagerly towards you.</p>";
    
    add_fanfic(6, $db);
    print_fanfic(6, $db);
}
?>


<?php
    
    print_footer(118, $db);
?>
</div>
</body>
</html>
