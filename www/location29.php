<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(29, $db);

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
<img src=assets/location29.png>
<h2>A Deserted Road</h2>

<i><p>Connor opens his eyes and blinks against the blinding sun. He realises he's lying on the ground, but he can't really remember how he got there. There are only vague images of something burning, exploding, and oh my God, all that noise, and then this distinct feeling of losing the ground under his feet. He thinks of roller-coaster rides, memories of laughter and pretending to fly for just a few seconds.</p></i>

<?php
    add_fanfic(46,$db);
    print "<p>Now Read On:";
    print_fanfic(46,$db);
    print_footer(29, $db);

    ?>

</div>
</body>
</html>
