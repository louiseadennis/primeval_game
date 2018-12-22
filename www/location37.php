<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(37, $db);

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
<img src=assets/location37.png>
<h2>The End</h2>

<p>You are standing on bare rock.  The air is hot and dry and you can see no signs of life.  The sun hangs low and much larger than you are accustomed to in the sky.</p>

<?php
    print_footer(37, $db);
    ?>

</div>
</body>
</html>
