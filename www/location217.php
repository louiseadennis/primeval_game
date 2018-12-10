<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(217, $db);
    
    $master = get_value_from_users("master", db);
    $master_query = 0;
    
    $sql = "SELECT * FROM characters;";
    if (!$result = $db->query($sql))
    showerror($db);
    $total = $result->num_rows;
    $char_id_list = get_value_from_users("char_id_list", $db);
    $char_id_array = explode(",", $char_id_list);
    if ($char_id_array->count == $total && !$master) {
        $master_query = 1;
    }

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
<img src=assets/location217.png>
<h2>A White Void</h2>

<p>Whiteness surrounds you in all directions.</p>

<?php
    
    if ($master_query == 1) {
        print "<p>A disembodied voice says: `Congratulations you have rescued all your companions and found the Land of Fiction.  Would you like to become Master of the Land of Fiction?";
        print "<form method=\"POST\" action=\"main.php\">";
        print "<input type=\"hidden\" name=\"location\" value=\"217\">";
        print "<input type=\"hidden\" name=\"travel_type\" value=\"none\">";
        print "<select name=\"master\">";
        print "<option value=\"1\" selected>Yes</option>";
        print "<option value=\"0\">No</option>";
        print "</select>";
        print "<input type=\"submit\" value=\"Submit Answer\"></p></form>";
    }
    
    print "<p>You seem to have no option but to walk<ul>";
    print "<li>";
    print_accessible_location_foot(218, $db);
    print "</li><li>";
    print_accessible_location_foot(219, $db);
    print "</li><li>";
    print_accessible_location_foot(220, $db);
    print "</li><li>";
    print_accessible_location_foot(221, $db);
    print "</li><li>";
    print_accessible_location_foot(222, $db);
    print "</li><li>";
    print_accessible_location_foot(223, $db);
    print "</li>";
    print "</ul></p>";
    
?>
</div>
</body>
</html>
