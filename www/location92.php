<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(92, $db);
    add_location_clue(92, $db);

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
<img src=assets/location92.png>
<h2>The Mitchell's Hotel</h2>

<i><p>Stephen glanced at his watch.</p>

<p>Fifteen minutes had passed since Lyle dispatched two of his men out into the night.</p>

<p>Without any instructions needing to be given, the members of Ryan’s team had all stopped drinking. They were simply watching and waiting. Quiet, hard-eyed and very, very dangerous.</p></i>

<p>On the bar a lone leaflet said.  Caps do it and you can keep it.</p>

<?php
    add_fanfic(49,$db);
    print "<p>Now Read On:</p>";
    print_fanfic(49,$db);
    print_travel(92,$db);
    print_footer(92,$db);
    ?>

</div>
</body>
</html>
