<?php
    require_once('./config/accesscontrol.php');
    require_once('./utilities.php');

    // Set up/check session and get database password etc.
    require_once('./config/MySQL.php');
    session_start();
    sessionAuthenticate();

    $db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
    check_location(23, $db);
    add_location_clue(23, $db);

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
<img src=assets/location23.png>
<h2>A Mayan Temple</h2>

<i><p>Abby frowned, her fingers tightening on her cup. "That doesn't look natural," she said, pointing at the screen. "It looks like bricks or something."</p>

<p>"It looks ancient, could be Mayan," Connor said, "look at those designs on the wall!"</p>


<p>Ryan straightened up beside her, the wrinkles on his face clearing. "Pull her out," he said, his voice more a command than a suggestion.</p></i>

<p>On the wall of the temple is  written:  Another way to spell EEK</p>

<?php
    add_fanfic(55,$db);
    print "<p>Now Read On:</p>";
    print_fanfic(55,$db);
    print_footer(23,$db);
    ?>

</div>
</body>
</html>
