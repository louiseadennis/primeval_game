<?php
    require_once('./config/accesscontrol.php');
    require_once('./utilities.php');

    // Set up/check session and get database password etc.
    require_once('./config/MySQL.php');
    session_start();
    sessionAuthenticate();

    $db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
    check_location(187, $db);
    add_location_clue(187, $db);

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
<img src=assets/location187.png>
<h2>A Forested Hill Range</h2>

<p>You are standing in the foothills of a mountain range, covered in sparse forest.  A note is pinned to a tree: `First letters of the following: The era of the Dunkleosteus, Ryan's first name, and the Prehistoric creature at the airport.'</p>

<?php
    print_footer(187,$db);
    ?>

</div>
</body>
</html>
