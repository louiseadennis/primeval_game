<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(225, $db);

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

<h2>The Library of the Land of Fiction</h2>

<?php
    $library_f = get_value_from_users("library_fanfic", $db);
    if ($library_f == 0) {
    
        $fanfic = random_fic($db);
        if ($fanfic != 0) {
            print "You select a book from the shelves.  It is: ";
            update_users("library_fanfic", $fanfic, $db);
            print_fanfic_with_cover($fanfic, $db);
            add_fanfic($fanfic, $db);
        } else {
            print "You have read all the books in the library";
        }
    } else {
        print "You are reading: ";
        print_fanfic_with_cover($library_f, $db);
    }
    print_accessible_location_foot(217, $db);

?>

</div>
</body>
</html>
