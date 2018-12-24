<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(124, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $emily_collected = check_for_character('emily',$db);
    if (!$emily_collected) {
        $visited =  get_value_from_users("new_character", $db);
        if ($visited != 'emily') {
            add_equipment("knife", $db);
            add_location_clue(124, $db);
        }
    }
?>
<div class=main>
<?php
print_standard_start($db);
?>
<div class=location>
<img src=assets/location124.png>
<h2>The Bank of a Stream</h2>

<p>You are standing on the bank of a stream that teams with wildlife.  Someone has carved 117 into a tree.</p>
<?php
    if (!$emily_collected) {
        update_users("new_character", 'emily', $db);
        print "<img src=assets/emily.png align=left>";
        print "<p>Emily is here.</p>";
    }
    
    print_footer(124,$db);
    ?>

</div>
</body>
</html>
