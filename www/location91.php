<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(91, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $becker_collected = check_for_character('becker',$db);
    if (!$becker_collected) {
        $visited =  get_value_from_users("new_character", $db);
        if ($visited != 'becker') {
            add_location_clue(91, $db);
            add_equipment("shotgun", $db);
        }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location91.png>
<h2>A School</h2>

<p>On a blackboard is written: What unites the plant that sugar comes from and the shape of the nose of a rocket.</p>
<?php
    if (!$becker_collected) {
        update_users("new_character", 'becker', $db);
        print "<img src=assets/becker.png align=left>";
        print "<p>Becker is here.</p>";
    }
    print_travel(91,$db);
    print_footer(91,$db);
    ?>

</div>
</body>
</html>
