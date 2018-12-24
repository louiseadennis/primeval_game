<?php
    require_once('./config/accesscontrol.php');
    require_once('./utilities.php');

    // Set up/check session and get database password etc.
    require_once('./config/MySQL.php');
    session_start();
    sessionAuthenticate();

    $db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
    check_location(96, $db);
    

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $jenny_collected = check_for_character('jenny', $db);
    if (!$jenny_collected) {
        $visited = get_value_from_users("new_character", $db);
        if ($visited != 'jenny') {
            add_equipment("budget", $db);
            add_location_clue(96, $db);
        }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location.png>
<h2>Placeholder</h2>

<p>I See with 20 20 Vision</p>

<?php
    if (!$jenny_collected) {
        update_users("new_character", 'jenny', $db);
        print "<img src=assets/jenny.png align=left>";
        print "<p>Jenny is here.</p>";
    }
    print_footer(96,$db);
?>

</div>
</body>
</html>
