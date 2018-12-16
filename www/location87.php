<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(87, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    add_location_clue(87,$db);
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location87.png>
<h2>Ootmarsum, The Netherlands</h2>

<i><p>Silently he and Stephen walked into the picturesque Dutch village. Small streets with cobblestones. Shops, art galleries and houses with Christmas decorations. The lights were atmospheric and it looked like a scene out of a book from Charles Dickens. Tourists were walking around, seemingly having a good time.</p></i>

<p>Strangely flags are spread across the town square spelling, in English `The last letters.'</p>

<?php
    add_fanfic(18, $db);
    print "To find  out more: ";
    print_fanfic(18, $db);
    
    print_travel(87, $db);
    print_footer(87, $db);
    ?>

</div>
</body>
</html>
