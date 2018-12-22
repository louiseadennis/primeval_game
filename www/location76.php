<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(76, $db);

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
<img src=assets/location76.png>
<h2>Tenerife</h2>

<p><i>Extraordinary rock formations could be seen along the way, some of them so strange that one could be tempted to think they had been designed on purpose to impress the visitors. The vegetation was not exuberant, but the green bushes that spread around the area added colour to the already varied tones of the ground and rocks, which went from pale brown to reddish grey, with black strokes mixed in between.</i></p>

<?php
    add_fanfic(29, $db);
    print "<p>Now read on: ";
    print_fanfic(29, $db);
    
    print_travel(76,$db);
    print_footer(76,$db);
    ?>

</div>
</body>
</html>
