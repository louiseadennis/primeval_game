<?php
// Stolen from PHP and MySQL by Hugh E. Williams and David Lane
function showerror() 
{
  die("Error " . mysql_errno() . " : " . mysql_error());
}

function get_user_id($connection)
{
  $uname = $_SESSION["loginUsername"];

  $sql = "SELECT user_id FROM users WHERE name = '{$uname}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
         $uid = $row["user_id"];
   	 return $uid;
     }
   }
}

function get_location($connection) {
  $uname = $_SESSION["loginUsername"];

  $sql = "SELECT location_id FROM users WHERE name = '{$uname}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
         $location = $row["location_id"];
   	 return $location_id;
     }
   }
}

function get_user_phase($connection)
{
  $uname = $_SESSION["loginUsername"];

  $sql = "SELECT phase FROM users WHERE name = '{$uname}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
         $phase = $row["phase"];
   	 return $phase;
     }
   }
}

function print_header() {
    print "<div class=header>";
    print "<a href=../profile.php>User Profile</a>";
    print "<hr>";
    print "</div>";
}
?>