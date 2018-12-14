<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(8, $db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
    print_header($db);
    $matt_collected = check_for_character('matt',$db);
    if (!$matt_collected) {
        $visited =  get_value_from_users("new_character", $db);
        if ($visited != 'matt') {
            add_equipment("emd", $db);
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

<p>Placeholder</p>
<?php
    if (!$matt_collected) {
        update_users("new_character", 'matt', $db);
        print "<img src=assets/matt.png align=left>";
        print "<p>Matt is here.  He has an EMD at full charge.  He suggests you head back to the ARC.</p>";
    }
    
    print_footer(8, $db);
    ?>

</div>
</body>
</html>
