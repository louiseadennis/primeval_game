<?php
// Stolen from PHP and MySQL by Hugh E. Williams and David Lane
function showerror() 
{
  die("Error " . mysql_errno() . " : " . mysql_error());
}

function default_charge()
{
	return 20;
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

function check_for_character($character, $connection) {
  $uname = $_SESSION["loginUsername"];

  $sql = "SELECT char_id_list FROM users WHERE name = '{$uname}'";
  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
         $char_id_list = $row["char_id_list"];

  	 $sql = "SELECT char_id FROM characters WHERE name = '{$character}'";
	 if (!$result = mysql_query($sql, $connection)) 
      	      showerror();
  
	 if (mysql_num_rows($result) != 1)
      	     return 0;
  	  else {
     	   	while ($row=mysql_fetch_array($result)) {
		    $char_id = $row["char_id"];
		    $char_id_array = explode(",", $char_id_list);
		    if (in_array($char_id, $char_id_array)) {
		       return 1;
		    } else {
   	 	      return 0;
		    }
		}
	   }
	}
  }
}

function update_character($character, $mysql) {
  $uname = $_SESSION["loginUsername"];

  $sql = "SELECT char_id_list FROM users WHERE name = '{$uname}'";
  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
         $char_id_list = $row["char_id_list"];

  	 $sql = "SELECT char_id FROM characters WHERE name = '{$character}'";
	 if (!$result = mysql_query($sql, $connection)) 
      	      showerror();
  
	 if (mysql_num_rows($result) != 1)
      	     return 0;
  	  else {
     	   	while ($row=mysql_fetch_array($result)) {
    		      array_push($char_id_array, $character);
		      $new_char_id_list = implode(",", $char_id_array);
	       	      $sql = "UPDATE users SET char_id_list='$new_char_id_list' WHERE name='{$uname}'";
		      if (!mysql_query($sql)) {
			      showerror();
		       } else {
		       	      return 1;
		}
		}
	}
	}
	}
}


function anomaly($location_id) {
	 print "<p>Before you is an anomaly!</p>";

	 print "<p><form method=\"POST\" action=\"main.php\">";
	 print "<input type=\"hidden\" name=\"location\" value=\"" . $location_id . "\">";
	 print "<input type=\"submit\" value=\"Go through the anomaly\">";
	 print "</form>";
	 print "</p>";
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
   	 return $location;
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
    print "<a href=profile.php>User Profile</a>";
    print "<hr>";
    print "</div>";
}

function print_anomaly($connection) {
  $uname = $_SESSION["loginUsername"];

  $sql = "SELECT prev_location FROM users WHERE name = '{$uname}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
         $prev = $row["prev_location"];
   	 if (! is_null($prev)) {
	    print "<form method=\"POST\" action=\"main.php\"><input type=\"hidden\" name=\"location\" value=\"" . $prev . "\"><p>You have just come through an anomaly. <input type=\"submit\" value=\"Go back through\"></p></form>";
	 }
     }
   }
}

function print_device($connection) {
    print "<div class=device>";
    print "<h4>The Device</h4>";
    $uname = $_SESSION["loginUsername"];

    $sql = "SELECT charge FROM users WHERE name = '{$uname}'";

    if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
    if (mysql_num_rows($result) != 1)
      return 0;
    else {
        while ($row=mysql_fetch_array($result)) {
          $charge = $row["charge"];
	  if (is_null($charge)) {
	     $default_charge = default_charge();
       	     $sql = "UPDATE users SET charge='$default_charge' WHERE name='$uname'";
	     if (!mysql_query($sql)) {
      	     	$message = "Database Error: " . mysql_errno() . " : " . mysql_error();
    	     }
	     $charge = $default_charge;
	  }
	  print "<p>Charge: " . $charge . "</p>";
	}
    }
    print "<form method=\"POST\" action=\"main.php\">";
    print "<select name=\"dial\">";
    print "<option select value=\"0\">0</option>";
    print "<option value=\"1\">1</option>";
    print "<option value=\"2\">2</option>";
    print "<option value=\"3\">3</option>";
    print "<option value=\"4\">4</option>";
    print "<option value=\"5\">5</option>";
    print "<option value=\"6\">6</option>";
    print "<option value=\"7\">7</option>";
    print "<option value=\"8\">8</option>";
    print "<option value=\"9\">9</option>";
    print "</select><br>";
    print "<input checked type=\"radio\" name=\"button1\" value=\"0\">A<br>";
    print "<input type=\"radio\" name=\"button1\" value=\"1\">B<br>";
    print "<input type=\"submit\" value=\"Activate Device\">";
    print "</form>";
    print "<hr>";
    print "</div>";
}

function check_location($location, $connection) {
  $real_location = get_location($connection);

  if ($real_location == $location) {
     return 1;
  } else {
     $location_string = "location" . $real_location;
     header("Location: $location_string.php");
     exit;
 }
}
?>