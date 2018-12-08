<?php 
    require_once('./config/accesscontrol.php');
    require_once('./utilities.php');

    // Set up/check session and get database password etc.
    require_once('./config/MySQL.php');
    session_start();
    sessionAuthenticate();

    $db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
    check_location(2, $db);

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
<img src=assets/location2.png>
<h2>The Shores of a Lake</h2>

<p>You are standing on the shore of a lake and you can see a volcano in the distance.  The ground is bare of life and the atmosphere is difficult to breath.</p>

<?php
    
    $action_done = get_value_from_users("action_done", $db);
    if (!$action_done) {
        print "<p><b>You must use breathing apparatus or will take damage.</b></p>";
    }
    ?>
</div>


</div>
</body>
</html>
