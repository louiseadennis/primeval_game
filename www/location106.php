<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(106, $db);
     add_location_clue(106,$db);

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
print_critter_trail_start(21,$db);
?>
<div class=location>
<img src=assets/location106.png>
<h2>The Future Sea</h2>

<p>You are in a future sea.  Mer-creatures crowd the cliffs above you.  Carved into the cliffs are the words `A Muslim Religious Festival'</p>

<?php
    
    $action_done = get_value_from_users("action_done", $db);
    if (!$action_done) {
        print "<p><b>You will need a boat otherwise you will be swept out of the anomaly again!</b></p>";
    }
    
    print_footer(106,$db);
    ?>


</div>
</body>
</html>
