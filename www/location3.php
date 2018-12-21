<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(3, $db);

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
<img src=assets/location3.png>
<h2>Arthur's Seat</h2>

<p><i>Nick Cutter sat in the grass, his hair being blown by the fickle breeze. His eyes narrow, he stared resolutely out over the city, no joy in seeing it bathed in the weak early evening sunshine. He barely moved when the man sat down beside him, but merely said, “Is that the best you can do, Ryan? I've seen you coming ever since you passed John Lewis.”</i></p>

<?php
    add_fanfic(24, $db);
    print "<p>Now read on: ";
    print_fanfic(24, $db);

    print_travel(3, $db);
    print_footer(3, $db);
    ?>

</div>
</body>
</html>
