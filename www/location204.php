<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(204, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $jess_collected = check_for_character('jess',$db);
    if (!$jess_collected) {
        $visited =  get_value_from_users("new_character", $db);
        if ($visited != 'jess') {
            add_equipment("add", $db);
            add_location_clue(204, $db);
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

<p>My first buried her brother and was buried in turn as punishment her name is the title of a play written by my third.  My second was her sister.  </p>

<?php
    if (!$jess_collected) {
        update_users("new_character", 'jess', $db);
        print "<img src=assets/jess.png align=left>";
        print "<p>Jess is here.  She has an anomaly detection device.</p>";
    }
    ?>
</div>
</body>
</html>
