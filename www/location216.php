<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(216, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $danny_collected = check_for_character('danny',$db);
    if (!$danny_collected) {
        $visited =  get_value_from_users("new_character", $db);
        if ($visited != 'danny') {
            add_location_clue(216, $db);
            add_equipment("a big stick", $db);
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

<p>Old MacDonald had a farm...</p>

<?php
    if (!$danny_collected) {
        update_users("new_character", 'danny', $db);
        print "<img src=assets/danny.png align=left>";
        print "<p>Danny is here.</p>";
    }
    ?>

</div>
</body>
</html>
