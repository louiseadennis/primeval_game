<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(59, $db);

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
<img src=assets/location59.png>
<h2>The Senckenberg Museum</h2>

<i><p>The Senckenberg Museum was located in one of the most expensive areas in Frankfurt with a lot of historic buildings, banks and embassies close by. It was only a few hundred metres from the fair area, where the Frankfurt book fair would start soon, and the stand builders were already working on the booths. The Senckenberg Association owned a huge historic city mansion that had been transformed into a museum, storage and research facilities. They were currently extending the building so that they could put more of their thousands of artefacts on display. The museum was also neighbouring one of the most important streets in the city, with three to four lanes in each direction and a huge grass strip separating them.

</p></i>

<?php
    add_fanfic(57, $db);
    print "<p>Now Read On:</p>"
    print_fanfic(57,$db);
    print_footer(59, $db);
    ?>

</div>
</body>
</html>
