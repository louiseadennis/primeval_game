<?php 

require_once('./config/accesscontrol.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
require_once('utilities.php');
session_start();
sessionAuthenticate();

$mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!mysql_select_db($mysql_database))
  showerror();

$location_id = mysqlclean($_POST, "location", 10, $mysql);
$prev_location = get_location($mysql);
$user_id = get_user_id($mysql);

if ($location_id=='') {
   header("Location: location1.php");
   exit;
} else if ($prev_location!=$location_id) {
   $sql = "UPDATE users SET prev_location='$prev_location' WHERE user_id='$user_id'";
   if (!mysql_query($sql)) {
      	$message = "Database Error: " . mysql_errno() . " : " . mysql_error();
    } else {
      $sql = "UPDATE users SET location_id='$location_id' WHERE user_id='$user_id'";
      if (!mysql_query($sql)) {
     	 $message = "Database Error: " . mysql_errno() . " : " . mysql_error();
    	 }
    }
}

$location_string = "location" . $location_id;
header("Location: $location_string.php");
exit;
    
?>
<html>
<head>
<title>52 Weeks of Primeval - The Gentlemen of Primeval</title>

<link rel="stylesheet" href="styles/default.css" type="text/css">
</head>
<body>
<div class=main>
<p>This is the main page.  It should not appear</p>
<?php
	echo "<p>$message</p>";
	echo "<p>prev_location:$prev_location</p>";
	echo "<p>location:$location_id</p>";
?>
</body>
</html>