<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(30, $db);

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
<img src=assets/location30.png>
<h2>A Lake Shore</h2>

<i><p>A wide expanse of water sparkled in the sunlight. A lake, stretching as far as the eye could see, surrounded by a flat expanse of dried mud. Horsetail ferns rose up out of the ground, and in the distance he could see a tall stand of some sort of pine trees. All around him, in the mud and sand of the shore, he could see tracks left by creatures that had come down to the water to drink. Some small prints, no bigger than a horse’s hoof, some huge, larger than the biggest elephant’s foot.
</p></i>

<?php
    add_fanfic(8, $db);
    print "To find  out more: ";
    print_fanfic(8, $db);
    print_footer(30, $db)
    ?>

</div>
</body>
</html>
