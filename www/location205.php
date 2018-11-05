<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(205, $db);

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
<img src=assets/location205.png>
<h2>A Poisonous Fog</h2>

<p>You are standing on bare rocks.  You can see virtually nothing beyond a thick green fog that makes it difficult to breath.

<?php
    
    $action_done = get_value_from_users("action_done", $db);
    if ($action_done) {
        
        // add_location_clue(15, $mysql);
    } else {
        print "<b>You must use breathing apparatus or you will take damage and be too busy choking to see anything.</b></p>";
    }
    ?>

</div>
</body>
</html>
