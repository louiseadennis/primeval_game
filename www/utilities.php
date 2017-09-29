<?php
date_default_timezone_set('UTC');

// Stolen from PHP and MySQL by Hugh E. Williams and David Lane
function showerror() 
{
  die("Error " . mysql_errno() . " : " . mysql_error());
}

function default_charge()
{
	return 20;
}

function default_health()
{
	return 5;
}

function maximum_phase()
{
	return 5;
}

function default_lester_recharges() {
	 return 10;
}

function default_stunned() {
	 return 5;
}


function print_junction_anomaly($anomaly, $connection) {
    $destination = get_anomaly_destination($anomaly, $connection);
    $water = get_value_for_location_id("water", $destination, $connection);
    print "<form method=\"POST\" action=\"main.php\"><input type=\"hidden\" name=\"location\" value=\"" . $destination . "\">";
    print "<input type=\"hidden\" name=\"last_action\" value=\"travel\">";
    print "<input type=\"hidden\" name=\"travel_type\" value=\"anomaly\">";
    if (fight($connection)) {
 	       print "<p><input type=\"submit\" value=\"Run through anomaly\"></p></form>";
    } else {
  	       print "<p><input type=\"submit\" value=\"Go through anomaly\"></p></form>";
    }

    if ($water) {
   	       print "<p>There is water pouring out of the anomaly.</p>";
    }
}

function add_location_clue($location_id, $connection) {
	 $clues = get_value_from_users("locationclues", $connection);
	 if (is_null($clues)) {
	    update_users("locationclues", $location_id, $connection);
	 } else {
	   $clue_array = explode(",", $clues);
	   if (!in_array($location_id, $clue_array)) {
	      $new_clues = $clues . "," . $location_id;
	      update_users("locationclues", $new_clues, $connection);
	      }
	 }
}

function get_present_day_locations($connection) {
    $sql = "SELECT * FROM locations WHERE present_day=1";
    
    if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
    $location_array = array();
    while ($row=mysql_fetch_array($result)) {
    	  $location_id = $row["location_id"];
	  $phase = get_value_from_users("phase", $connection);
	  if ($phase != 1 || $location_id != 19) {
             array_push($location_array, $row["location_id"]);
	  }
    }
    return $location_array;
}

function get_value_from_users($column, $connection) {
  $uname = $_SESSION["loginUsername"];

  $sql = "SELECT {$column}  FROM users WHERE name = '{$uname}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["$column"];
	   return $value;
     }
  }
}

function update_users($column, $value, $connection) {
    $uname = $_SESSION["loginUsername"];
    $sql = "UPDATE users SET {$column}='{$value}' WHERE name='$uname'";
    if (!mysql_query($sql, $connection)) {
       showerror();
    }
    return 1;
}

function junction_here($connection) {
    $user_id = get_user_id($connection);
    $location_id = get_location($connection);
    $sql = "SELECT a1 FROM junctions WHERE user_id='$user_id' AND location_id='$location_id'";
    if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     return 1;
  }
}

function change_anomaly($anomaly,  $prev_location, $connection) {
    $user_id = get_user_id($connection);
    $location_id = get_location($connection);
    $anomaly_string = "a" . $anomaly;
    $sql = "SELECT $anomaly_string FROM junctions WHERE user_id='$user_id' AND location_id='$location_id'";

    if (!$result = mysql_query($sql, $connection)) 
      showerror();

    while ($row=mysql_fetch_array($result)) {
          $value = $row["$anomaly_string"];
	  if ($value == 0) {
	     $d60 = rand(1, 60);
    	    $sql = "UPDATE junctions SET {$anomaly_string}=$d60 WHERE location_id='$location_id' AND user_id='$user_id'";
	    if (!mysql_query($sql, $connection)) {
       	       showerror();
    	    }
	  } else if ($value != $prev_location) {
    	    $sql = "UPDATE junctions SET {$anomaly_string}=0 WHERE location_id='$location_id' AND user_id='$user_id'";
	    if (!mysql_query($sql, $connection)) {
       	       showerror();
    	    }
	  }
    }

  
}

function unresolved_event($connection) {
    $user_id = get_user_id($connection);
    $location_id = get_location($connection);
    $sql = "SELECT event_id FROM events WHERE user_id='$user_id' AND location_id='$location_id' AND resolved=0";

    if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     return 1;
  }
}

function get_unresolved_event_id($connection) {
    $user_id = get_user_id($connection);
    $location_id = get_location($connection);
    $sql = "SELECT event_id FROM events WHERE user_id='$user_id' AND location_id='$location_id' AND resolved=0";

    if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
    if (mysql_num_rows($result) != 1)
      return 0;
    else {
     while ($row=mysql_fetch_array($result)) {
      $value = $row["event_id"];
      return $value;
      }
    }
}

function get_anomaly_destination($anomaly, $connection) {
    $user_id = get_user_id($connection);
    $location_id = get_location($connection);
    $sql = "SELECT {$anomaly} FROM junctions WHERE user_id='$user_id' AND location_id='$location_id'";

    if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
    if (mysql_num_rows($result) != 1)
      return 0;
    else {
     while ($row=mysql_fetch_array($result)) {
      $value = $row["$anomaly"];
      return $value;
      }
    }
}

function fight($connection) {
    if (unresolved_event($connection)) {
       $event_id = get_unresolved_event_id($connection);
       $fight = get_value_for_event_id("fight", $event_id, $connection);
       return fight;
    }

    return 0;
}

function update_location($location_id, $column, $value, $connection) {
    $sql = "UPDATE locations SET {$column}='{$value}' WHERE location_id='$location_id'";
    if (!mysql_query($sql, $connection)) {
       showerror();
    }
    return 1;
}

function update_event($event_id, $column, $value, $connection) {
    $sql = "UPDATE events SET {$column}='{$value}' WHERE event_id='$event_id'";
    if (!mysql_query($sql, $connection)) {
       showerror();
    }
    return 1;
}

function get_value_for_name_from($column, $table, $name, $connection) {
  $sql = "SELECT {$column} FROM {$table} WHERE name = '{$name}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["$column"];
	   return $value;
     }
  }
}

function get_value_for_equip_id($column, $equip_id, $connection) {
  $sql = "SELECT {$column} FROM equipment WHERE equip_id = '{$equip_id}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["$column"];
	   return $value;
     }
  }
}

function get_value_for_critter_id($column, $critter_id, $connection) {
  $sql = "SELECT {$column} FROM critters WHERE critter_id = '{$critter_id}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["$column"];
	   return $value;
     }
  }
}

function get_value_for_weapon_id($column, $weapon_id, $connection) {
  $sql = "SELECT {$column} FROM weapons WHERE weapon_id = '{$weapon_id}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["$column"];
	   return $value;
     }
  }
}

function get_weapon_id($equip_id, $connection) {
  $sql = "SELECT weapon_id FROM weapons WHERE equip_id = '{$equip_id}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["weapon_id"];
	   return $value;
     }
  }
}

function get_value_for_location_id($column, $location_id, $connection) {
  $sql = "SELECT {$column} FROM locations WHERE location_id = '{$location_id}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["$column"];
	   return $value;
     }
  }
}

function get_value_for_event_id($column, $event_id, $connection) {
  $sql = "SELECT {$column} FROM events WHERE event_id = '{$event_id}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["$column"];
	   return $value;
     }
  }
}


function get_value_for_char_id($column, $char_id, $connection) {
  $sql = "SELECT {$column} FROM characters WHERE char_id = '{$char_id}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["$column"];
	   return $value;
     }
  }
}

function get_user_id($connection)
{
    return get_value_from_users("user_id", $connection);
}

function check_for_character($character, $connection) {
   $char_id_list = get_value_from_users("char_id_list", $connection);

   if ($char_id_list != 0 ) {
      $char_id = get_value_for_name_from("char_id", "characters", $character, $connection);
      $char_id_array = explode(",", $char_id_list);
      if (in_array($char_id, $char_id_array)) {
      	 return 1;
      } else {
         return 0;
      }
   }
}

function collect_new_characters($connection) {
	 $new_character = get_value_from_users("new_character", $connection);
	 if ($new_character != "") {
	    $char_id_list = get_value_from_users("char_id_list", $connection);
	    if ($char_id_list == 0 || $char_id_list == '') {
	       update_users("char_id_list", $new_character, $connection);
	    } else {
	       $new_char_id_list = $char_id_list . "," . $new_character;
	       }
	 }
}

function check_for_equipment($equip, $connection) {
   $equip_id_list = get_value_from_users("equipment", $connection);

   if ($equip_id_list != 0 ) {
      $equip_id = get_value_for_name_from("equip_id", "equipment", $equip, $connection);
      $equip_id_array = explode(",", $equip_id_list);
      if (in_array($equip_id, $equip_id_array)) {
      	 return 1;
      } else {
         return 0;
      }
   }
}

function anomaly($location_id) {
	 print "<p>Before you is an anomaly!</p>";

	 print "<p><form method=\"POST\" action=\"main.php\">";
	 print "<input type=\"hidden\" name=\"location\" value=\"" . $location_id . "\">";
	 print "<input type=\"hidden\" name=\"travel_type\" value=\"anomaly\">";
	 print "<input type=\"hidden\" name=\"last_action\" value=\"travel\">";
	 print "<input type=\"submit\" value=\"Go through the anomaly\">";
	 print "</form>";
	 print "</p>";
}

function print_accessible_location($location_id, $mysql) {
	 print "<p><form method=\"POST\" action=\"main.php\">";
	 print "<input type=\"hidden\" name=\"location\" value=\"" . $location_id . "\">";
	 print "<input type=\"hidden\" name=\"travel_type\" value=\"vehicle\">";
	 print "<input type=\"hidden\" name=\"last_action\" value=\"travel\">";
	 $name = get_value_for_location_id("name", $location_id, $mysql);
	 print "<input type=\"submit\" value=\"$name\">";
	 print "</form>";
	 print "</p>";
}

function get_location($connection) {
    return get_value_from_users("location_id", $connection);
}

function get_user_phase($connection)
{
    return get_value_from_users("phase", $connection);
}

function print_header($connection) {
    print "<div class=header>";
    collect_new_characters($connection);
    print "<a href=profile.php>User Profile</a>";
    $has_log = get_value_from_users("has_log", $connection);
    if ($has_log) {
       print "       <a href=log.php>Log Book</a>";
    }
    print "<hr>";
    print "</div>";
}

function print_anomaly($connection) {
   $travel_type = get_value_from_users("travel_type", $connection);
   $random_anomalies = get_value_from_users("random_anomalies", $connection);
   $second_anomaly = 0;
   if ($random_anomalies) {
      $location_id = get_location($connection);
      $anomaly_chance = get_value_for_location_id("anomaly_chance", $location_id, $connection);
      $has_device = get_value_from_users("has_device", $connection);
      if (!$has_device) {
      	 $anomaly_chance = 40;
      }
      $d100_roll = rand(1, 100);
      if ($d100_roll <= $anomaly_chance) {
	    $second_anomaly = 1;
	    $d60_roll = rand(1, 60);
      }
   }

   if ($travel_type == "anomaly" || $travel_type == "device") {
      $prev = get_value_from_users("prev_location", $connection);
      $water = get_value_for_location_id("water", $prev, $connection);
      if (!is_null($prev)) {
      	 print "<form method=\"POST\" action=\"main.php\"><input type=\"hidden\" name=\"location\" value=\"" . $prev . "\">";
	 print "<input type=\"hidden\" name=\"last_action\" value=\"travel\">";
     	 print "<input type=\"hidden\" name=\"travel_type\" value=\"anomaly\">";
      

	$last_action = get_value_from_users("last_action", $connection);
   	if ($last_action == "travel") {
           $hp = get_value_from_users("hp", $connection);
      	   if ($hp > 0) {
            if ($travel_type == "anomaly") {
              if (fight($connection)) {
	      	 print "<p>You walk through the anomaly and are attacked.  <input type=\"submit\" value=\"Run back to the anomaly\"></p></form>";
	      } else {
     	      	print "<p>You have come through an anomaly. <input type=\"submit\" value=\"Go back through\"></p></form>";
              }

            } else {
              if (fight($connection)) {
	      	 print "<p>The Device opens an anomaly.  You walk through the anomaly and are attacked.  <input type=\"submit\" value=\"Run back to the anomaly\"></p></form>";
              } else {
     	      	print "<p>The Device opens an anomaly and you step through. <input type=\"submit\" value=\"Go back through Anomaly\"></p></form>";
              }
            }
	 }
        } else {
	      $hp = get_value_from_users("hp", $connection);
      	      if ($hp > 0) {
	      	 if (fight($connection)) {
	       	    print "<p>The anomaly you came through is here.   <input type=\"submit\" value=\"Run back to the anomaly\"></p></form>";
	   	 } else {
	       	   print "<p>The anomaly you came through is here.   <input type=\"submit\" value=\"Go back through\"></p></form>";
		}
	   }
	}

        if ($water) {
      	   print "<p>There is water pouring out of the anomaly.</p>";
        } 
      }

      if ($second_anomaly) {
             $water = get_value_for_location_id("water", $d60_roll, $connection);
	     print "<form method=\"POST\" action=\"main.php\"><input type=\"hidden\" name=\"location\" value=\"" . $d60_roll . "\">";
	     print "<input type=\"hidden\" name=\"last_action\" value=\"travel\">";
     	     print "<input type=\"hidden\" name=\"travel_type\" value=\"anomaly\">";
	     if (fight($connection)) {
   	       print "<p>There is a second anomaly here. <input type=\"submit\" value=\"Run through anomaly\"></p></form>";
	     } else {
   	       print "<p>There is a second anomaly here. <input type=\"submit\" value=\"Go through anomaly\"></p></form>";
	    }

	    if ($water) {
      	       print "<p>There is water pouring out of the anomaly.</p>";
      	    }
      }
  } else if ($second_anomaly) {
             $water = get_value_for_location_id("water", $d60_roll, $connection);
	     print "<form method=\"POST\" action=\"main.php\"><input type=\"hidden\" name=\"location\" value=\"" . $d60_roll . "\">";
	     print "<input type=\"hidden\" name=\"last_action\" value=\"travel\">";
     	     print "<input type=\"hidden\" name=\"travel_type\" value=\"anomaly\">";
	     if (fight($connection)) {
   	       print "<p>There is an anomaly here. <input type=\"submit\" value=\"Run through anomaly\"></p></form>";
	     } else {
   	       print "<p>There is an anomaly here. <input type=\"submit\" value=\"Go through anomaly\"></p></form>";
	    }

	    if ($water) {
      	       print "<p>There is water pouring out of the anomaly.</p>";
      	    }
  }
}

function print_anomaly_no_random($connection) {
   $travel_type = get_value_from_users("travel_type", $connection);

  if ($travel_type == "anomaly" || $travel_type == "device") {
      $prev = get_value_from_users("prev_location", $connection);
      $water = get_value_for_location_id("water", $prev, $connection);
      if (!is_null($prev)) {
      	 print "<form method=\"POST\" action=\"main.php\"><input type=\"hidden\" name=\"location\" value=\"" . $prev . "\">";
	 print "<input type=\"hidden\" name=\"last_action\" value=\"travel\">";
     	 print "<input type=\"hidden\" name=\"travel_type\" value=\"anomaly\">";
      

	$last_action = get_value_from_users("last_action", $connection);
   	if ($last_action == "travel") {
           $hp = get_value_from_users("hp", $connection);
      	   if ($hp > 0) {
            if ($travel_type == "anomaly") {
              if (fight($connection)) {
	      	 print "<p>You walk through the anomaly and are attacked.  <input type=\"submit\" value=\"Run back to the anomaly\"></p></form>";
	      } else {
     	      	print "<p>You have come through an anomaly. <input type=\"submit\" value=\"Go back through\"></p></form>";
              }

            } else {
              if (fight($connection)) {
	      	 print "<p>The Device opens an anomaly.  You walk through the anomaly and are attacked.  <input type=\"submit\" value=\"Run back to the anomaly\"></p></form>";
              } else {
     	      	print "<p>The Device opens an anomaly and you step through. <input type=\"submit\" value=\"Go back through Anomaly\"></p></form>";
              }
            }
	 }
        } else {
	      $hp = get_value_from_users("hp", $connection);
      	      if ($hp > 0) {
	      	 if (fight($connection)) {
	       	    print "<p>The anomaly you came through is here.   <input type=\"submit\" value=\"Run back to the anomaly\"></p></form>";
	   	 } else {
	       	   print "<p>The anomaly you came through is here.   <input type=\"submit\" value=\"Go back through\"></p></form>";
		}
	   }
	}

        if ($water) {
      	   print "<p>There is water pouring out of the anomaly.</p>";
        } 
      }
   }
}

function leek_critter_id($leek_critter) {
	 if ($leek_critter == 1) {
	    return 4;
	 } else if ($leek_critter == 2) {
	   return 5;
	 } else {
	   return 1;
	 }
}

function get_a_critter($location_id, $connection) {
	 $critter_ids = get_value_for_location_id("critter", $location_id, $connection);
	 $critter_array = explode(",", $critter_ids);
	 $pick = rand(0, count($critter_array) - 1);
	 return $critter_array[$pick];
}		  

function create_new_fight_event($critter_id, $connection) {
	 $user_id = get_user_id($connection);
	 $location_id = get_location($connection);
         $default_hp = get_value_for_critter_id("hp", $critter_id, $connection);
	 $sql = "INSERT INTO events (user_id, location_id, fight, critter, critter_hp, resolved) values ('$user_id', $location_id, 1, $critter_id, $default_hp, 0)";
	 if (!mysql_query($sql))
	    showerror();
}

function create_anomaly_junction($connection) {
	 $user_id = get_user_id($connection);
	 $location_id = get_location($connection);
	 $sql = "INSERT INTO junctions (user_id, location_id) values ('$user_id', $location_id)";
	 if (!mysql_query($sql))
	    showerror();

	 junction_anomaly_set("a1", $connection);
	 junction_anomaly_set("a2", $connection);
	 junction_anomaly_set("a3", $connection);
	 junction_anomaly_set("a4", $connection);
	 junction_anomaly_set("a5", $connection);
	 junction_anomaly_set("a6", $connection);
	 junction_anomaly_set("a7", $connection);
	 junction_anomaly_set("a8", $connection);
	 junction_anomaly_set("a9", $connection);
	 junction_anomaly_set("a10", $connection);

}

function junction_anomaly_set($anomaly, $connection) {
	 $user_id = get_user_id($connection);
	 $location_id = get_location($connection);
         $coin = rand(0,1);
	 if ($coin == 0) {
	    $sql = "UPDATE junctions set {$anomaly}=0 where user_id='$user_id' AND location_id='$location_id'";
	    if (!mysql_query($sql, $connection)) {
       	       showerror();
            }
	 } else {
	    $dice = rand(1, 60);
	    $sql = "UPDATE junctions set {$anomaly}=$dice where user_id='$user_id' AND location_id='$location_id'";
	    if (!mysql_query($sql, $connection)) {
       	       showerror();
            }
	 }
}

function critter_attack($leek, $connection) {
         $location_id = get_value_from_users("location_id", $connection);
	 $fight_just_done = 0;
	 if ($leek) {
 	      $leek_critter = get_value_from_users("leek_critter", $connection);
	      if ($leek_critter < 4) {
	       	  $fight = 1;
	      }
	 } else {
	     $fight = fight($connection);
	 }

	 $unresolved_event = unresolved_event($connection);

	 if ($unresolved_event) {
	    $event_id = get_unresolved_event_id($connection);
	    $critter_stunned = get_value_for_event_id("stunned", $event_id, $connection);
	 } else {
	    $critter_stunned = 0;
	 }

	 if (!$unresolved_event && !$leek && !$fight_just_done) {
	    $fight_chance = get_value_for_location_id("fight_chance", $location_id, $connection);
	    if ($fight_chance > 0) {
	       $dice = rand(0,100);
	       if ($dice < $fight_chance) {
	       	  $fight = 1;
         	  $critter_id = get_a_critter($location_id, $connection);
		  create_new_fight_event($critter_id, $connection);
                  $event_id = get_unresolved_event_id($connection);
		  update_location($location_id, "current_critter", $critter_id, $connection);
	       }
	    }
	 } 

	 if ($fight) {
	         if ($leek) {
 	 	    $critter_id = leek_critter_id($leek_critter);
		    $critter_hp = get_value_from_users("leek_critter_hp", $connection);
		 } else {
 	 	   $critter_id = get_value_for_event_id("critter", $event_id, $connection);
		   $critter_hp = get_value_for_event_id("critter_hp", $event_id, $connection);
		 }
          	 $critter_name = get_value_for_critter_id("name", $critter_id, $connection);

		 if ($critter_hp > 0 && $critter_stunned == 0) {
                    print "<p><b>You are being attacked by a $critter_name</b></p>";
		    $hit_percentage = get_value_for_critter_id("hit_percentage", $critter_id, $connection);
		    $d10_roll = rand(0, 100);
		    if ($d10_roll < $hit_percentage) {
		       $hp = get_value_from_users("hp", $connection);
		       $hp = $hp - 1;
		       update_users("hp", $hp, $connection);
		       $now = now();
      	 	       update_users("healing_start", $now, $connection);
		       print "<p>The $critter_name strikes you.</p>";
		    } else {
		       print "<p>But you dodge out of the way!</p>";
		    }
		 } else {
		   update_event($event_id, "fight", 0, $connection);
		 }

		 if ($critter_hp <= 0) {
		   update_event($event_id, "resolved", 1, $connection);
		 }
	 }
	 if ($critter_stunned > 0) {
 	      $critter_id = get_value_for_event_id("critter", $event_id, $connection);
       	      $critter_name = get_value_for_critter_id("name", $critter_id, $connection);
	      print "<p>There is an unconscious $critter_name here</p>";
	      $new_stunned = $critter_stunned - 1;
	      update_event($event_id, "stunned", $new_stunned, $connection);
	      if ($critter_stunned == 1) {
	      	 print "<p>But it seems to be waking up.</p>";
		 update_event($event_id, "fight", 1, $connection);
	      }
	 } 
} 


function player_attack($leek, $weapon_id, $connection) {
         $location_id = get_value_from_users("location_id", $connection);
	 if ($leek) {
            $critter_hp = get_value_from_users("leek_critter_hp", $connection);
 	    $critter = get_value_from_users("leek_critter", $connection);
	    $critter_id = leek_critter_id($critter);
	 } else {
           $event_id = get_unresolved_event_id($connection);
	   $critter_hp = get_value_for_event_id("critter_hp", $event_id, $connection);
 	   $critter_id = get_value_for_event_id("critter", $event_id, $connection);
	 }
	 
         $critter_name = get_value_for_critter_id("name", $critter_id, $connection);
	 if ($critter_hp > 0) {
		$hit_percentage = get_value_for_weapon_id("hit_percentage", $weapon_id, $connection);
		$d10_roll = rand(0, 100);
		if ($d10_roll < $hit_percentage) {
		       $damage = get_value_for_weapon_id("damage", $weapon_id, $connection);
		       $critter_hp = $critter_hp - $damage;
		       if ($leek) {
		       	  update_users("leek_critter_hp", $critter_hp, $connection);
		       } else {
		          update_event($event_id, "critter_hp", $critter_hp, $connection);
		       }
		       if ($critter_hp <= 0) {
		       	  print "<p>The $critter_name falls to the ground dead.</p>";
		       } else {
		         if ($weapon_id == 5) {
 		       	    print "<p>You stab the $critter_name but it continues to attack.</p>";
			 } else if ($weapon_id == 6) {
 		       	    print "<p>You hit the $critter_name and knock it out.</p>";
			    if (!$leek) {
			       update_event($event_id, "stunned", default_stunned(), $connection);
			    } else {
			      update_users("leek_critter_hp", -1, $connection);
			      print "<p>It is removed to the menagerie</p>";
			    }
			 } else if (get_value_for_weapon_id("stuns", $weapon_id, $connection)) {
			    print "<p>You stun the $critter_name.</p>";
			    if (!$leek) {
			       update_event($event_id, "stunned", default_stunned(), $connection);
			    } else {
			      update_users("leek_critter_hp", -1, $connection);
			      print "<p>It is removed to the menagerie</p>";
			    }
			} else {
 		       	  print "<p>You shoot the $critter_name but it continues to attack.</p>";
			}
		       }
		    } else {
		      	 print "<p>You miss the $critter_name.</p>";
		    }
	 }
}

function resolve_events($connection) {
    $user_id = get_user_id($connection);
    $sql = "SELECT event_id FROM events WHERE user_id='$user_id' AND location_id='$location_id' AND resolved=0";

    if (!$result = mysql_query($sql, $connection)) 
      showerror();

    while ($row=mysql_fetch_array($result)) {
      $value = $row["event_id"];
      $critter_stunned = get_value_for_event_id("stunned", $event_id, $connection);
      if ($critter_stunned > 0) {
 	      $critter_id = get_value_for_event_id("critter", $event_id, $connection);
       	      $critter_name = get_value_for_critter_id("name", $critter_id, $connection);
	      $new_stunned = $critter_stunned - 1;
	      update_event($event_id, "stunned", $new_stunned, $connection);
	      if ($critter_stunned == 0) {
		 update_event($event_id, "resolved", 1, $connection);
	      }
      } 
    }


}


function fight_event($user_id, $location_id, $connection) {
	 $location_id = get_value_from_users("location_id", $connection);
	 $fight = get_value_for_location_id("fight", $location_id, $connection);
	 return $fight;
}

function print_device($connection) {
     $h = get_value_from_users("has_device", $connection);
     if ($h == 1) {
     	   $charge = get_value_from_users("charge", $connection);
       
           print "<div class=device>";
       	   print "<h4>The Device</h4>";
       	   if (is_null($charge)) {
       	      $default_charge = default_charge();
	      update_users("charge", $default_charge, $connection);
	      $charge = $default_charge;
           } else {
             $recharge_start = get_value_from_users("recharge_start", $connection);
             $time_difference = check_charge($recharge_start, $connection);
             if ($time_difference > 0) {
             if ($time_difference + $charge > default_charge()) {
	     	$charge = default_charge();
		 update_users("charge", $charge, $connection);
	     } else {
	        $charge = $time_difference + $charge;
		$now = now();
      	 	update_users("recharge_start", $now, $connection);
		update_users("charge", $charge, $connection);
             }
            }
          }
     print "<p>Charge: " . $charge . "</p>";
     print "<form method=\"POST\" action=\"main.php\">";
     print "<table>";
     print "<tr><td><select name=\"dial\">";
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
     print "</select> &nbsp; &nbsp; </td>";
     print "<td>";
     print "<input checked type=\"radio\" name=\"button1\" value=\"0\">A<br>";
     print "<input type=\"radio\" name=\"button1\" value=\"1\">B<br>";
     print "<input type=\"radio\" name=\"button1\" value=\"2\">C&nbsp; &nbsp;</td>";
     print "<input type=\"hidden\" name=\"last_action\" value=\"travel\">";
     print "<input type=\"hidden\" name=\"travel_type\" value=\"device\">";
     $phase = get_value_from_users("phase", $connection);
     if ($phase < 3) {
     	print "<input type=\"hidden\" name=\"button2\" value=\"0\"></tr></table>";
     } else {
     print "<td>";
     	   print "<input checked type=\"radio\" name=\"button2\" value=\"0\">Off<br>";
     	   print "<input type=\"radio\" name=\"button2\" value=\"1\">On<br></td></tr></table>";
     }
     if ($charge > 0) {
         $hp = get_value_from_users("hp", $connection);
         $healing_start = get_value_from_users("healing_start", $connection);
         if (!is_null($healing_start)) {
            $heals = check_healing($healing_start, $connection);
         }
         if ($hp > 0 ||  $heals > 0) {
	    print "<input type=\"submit\" value=\"Activate Device\">";
	 } else {
	    print "<p>You are unconscious and unable to use the device.</p>";
	 }
     } else {
        print "<p>The device is out of charge.  It recharges at 1 unit per hour.  You will need to wait.</p>";
     }
     print "</form>";
     print "<hr>";
     print "</div>";
     }
}

function use_device($dial, $button1, $button2, $connection) {
      $location_id = get_location_from_coords($dial, $button1, $button2, $connection);
      $phase = get_value_from_users("phase", $connection);
      $log = get_value_from_users("log", $connection);
      $log_entry = "(" . $dial . "," . $button1 . "," . $button2 . "," . $phase . ")";
      $log_array = explode(":", $log);
      if (!in_array($log_entry, $log_array)) {
      	 if ($log != '') {
      	    $new_log = $log . ":" . $log_entry;
	    update_users("log", $new_log, $connection);
	 } else {
	    update_users("log", $log_entry, $connection);
	 }
      }
      $charge = get_value_from_users("charge", $connection);
      if ($charge == default_charge()) {
	 $now = now();
      	 update_users("recharge_start", $now, $connection);
      }
      $new_charge = $charge - 1;
      update_users("charge", $new_charge, $connection);
      return $location_id;
}

function check_charge($recharge_start, $connection) {
	 $now = new DateTime();
	 $rtime = DateTime::createFromFormat('Y\-m\-d\ H:i:s', $recharge_start);
	 $diff  = $rtime->diff($now);
	 if (($t = $diff->format("%m")) > 0)
	    $charges = default_charge();
	 else if (($t = $diff->format("%d")) > 0)
	    $charges = default_charge();
	 else if (($t = $diff->format("%H")) > 0)
	    $charges = $t;
//	 else if (($t = $diff->format("%i")) > 0)
//	    $charges = 2; 
	 else
	    $charges = 0;
	 return $charges;
}

function check_healing($healing_start, $connection) {
	 $now = new DateTime();
	 $htime = DateTime::createFromFormat('Y\-m\-d\ H:i:s', $healing_start);
	 $diff  = $htime->diff($now);
	 if (($t = $diff->format("%m")) > 0)
	    $heals = default_charge();
	 else if (($t = $diff->format("%d")) > 0)
	    $heals = default_charge();
	 else if (($t = $diff->format("%H")) > 0)
	    $heals = $t;
//	 else if (($t = $diff->format("%i")) > 0)
//	    $heals = 2; 
	 else
	    $heals = 0;
	 return $heals;
}

function now() {
     	 $datetime = new DateTime();
	 $now = $datetime->format('Y\-m\-d\ H:i:s');
	 return $now;
}

function get_location_from_coords($dial, $button1, $button2, $connection) {
  $sql = "SELECT location_id FROM locations WHERE tm_coord_1 = {$dial} AND tm_coord_2 = {$button1} AND tm_coord_3 = {$button2}";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
     while ($row=mysql_fetch_array($result)) {
     	   $value = $row["location_id"];
	   return $value;
     }
  }
}

function print_standard_start($mysql) {
      print_health($mysql);
      print_character_joined($mysql);
      print_item_used(0, $mysql);
      critter_attack(0, $mysql);
      print_anomaly($mysql);
}

function print_leek_start($mysql) {
      print_health($mysql);
      print_character_joined($mysql);
      print_item_used(1, $mysql);
      critter_attack(1, $mysql);
      print_anomaly($mysql);
}

function print_health($mysql) {
     $hp = get_value_from_users("hp", $mysql);
     if ($hp < default_health()) {
          $healing_start = get_value_from_users("healing_start", $mysql);
	  if (!is_null($healing_start)) {
	  	  $time_difference = check_healing($healing_start, $mysql);
          	  if ($time_difference > 0) {
       	     	     if ($time_difference + $hp > default_health()) {
	     	     	$hp = default_health();
		 	update_users("hp", $hp, $mysql);
	     	     } else {
	               $hp = $time_difference + $hp;
		       $now = now();
      	 	       update_users("healing_start", $now, $mysql);
		       update_users("hp", $hp, $mysql);
             	    }
             }
          }
     }
     if ($hp == 0) {
     	print "<p><b>You are Unconscious!</b>  You can do nothing.  Check back in 1 hour.</p>";
     } else if ($hp == 1) {
        print "<p>You are badly injured</p>";
     } else if ($hp == 2) {
        print "<p>You are injured</p>";
     } else if ($hp == 3) {
        print "<p>You are slightly injured</p>";
     } else if ($hp == 4) {
        print "<p>You are grazed</p>";
     }
}

function print_character_joined($connection) {
     $last_action = get_value_from_users("last_action", $connection);
     if ($last_action == "travel") {
     	$new_character = get_value_from_users("new_character", $connection);
	if ($new_character != '') {
   	   $char_id_list = get_value_from_users("char_id_list", $connection);
	   $char_id = get_value_for_name_from("char_id", "characters", $new_character, $connection);
   	   if ($char_id_list != 0 ) {
	      $new_char_id_list = $char_id_list . "," . $char_id;
	      update_users("new_character", '', $connection);
	      update_users("char_id_list", $new_char_id_list, $connection);
           } else {
	      update_users("new_character", '', $connection);
	      update_users("char_id_list", $char_id, $connection);
	   }
	   $ucchar = ucfirst($new_character);
	   print "<p>$ucchar has joined you on your travels.  He is stored in your user profile.</o>";	   
	}
     }
}

function print_equipment($connection) {
   $equip_id_list = get_value_from_users("equipment", $connection);
   $uses_list = get_value_from_users("uses", $connection);
   if (! is_null($equip_id_list) && $equip_id_list != "") {
      print "<h2>Equipment</h2>";
      $hp = get_value_from_users("hp", $connection);
      if ($hp > 0) {
         $equip_id_array = explode(",", $equip_id_list);
      	 $uses_array = explode(",", $uses_list);
      	 $i = 0;
      	 print "<table border>";
      	 print "<tr><th>Item</th><th>Uses Left</th><th>Use</th></tr>";
      	 foreach ($equip_id_array as $equip) {
      	      print "<tr>";
	      print "<form method=\"POST\" action=\"main.php\">";
	      print "<td>";
	      $equip_name = get_value_for_equip_id("name", $equip, $connection);
	      print $equip_name;
	      print "</td><td>";
	      if ($uses_array[$i] < 500) {
	      	      print $uses_array[$i];
	      }
	      print "</td><td>";
	      print "<input type=\"hidden\" name=\"travel_type\" value=\"none\">";
	      print "<input type=\"hidden\" name=\"item_used\" value=$equip>";
	      print "<input type=\"hidden\" name=\"last_action\" value=\"item\">";
	      if ($uses_array[$i] > 0) {
	      	      print "<input type=\"submit\" value=\"Use\">";
	      } 
	      print "</td></form></tr>";
	      $i++;
         }
         print "</table>";
      } else {
      	 print "<p>You are unconscious and unable to use your equipment.</p>";
      }
   }
}

function print_item_used($leek, $connection) {
	 $last_action = get_value_from_users("last_action", $connection);
	 $item_used = get_value_from_users("item_used", $connection);

	 if ($leek) {
	      $leek_critter = get_value_from_users("leek_critter", $connection);
	      if ($leek_critter < 5) {
	      	 $fight = 1;
	      } else {
	      	$fight = 0;
	      }
	 } else {
	      $fight = fight($connection);
	 }

	 if ($item_used != 0 & $last_action == "item") {
	      $can_use = item_used($leek, $fight, $item_used, $connection);
	      if ($can_use) {
	         if (!$fight || !is_weapon($item_used, $connection)) {
		      $default_message = get_value_for_equip_id("use_message", $item_used, $connection);
	      	      print "<p>$default_message</p>";
		 }
	      } else {
	      	 print "<p>You can no longer use this item</p>";
	      }
	      update_users("item_used", 0, $connection);
	 }
}

function item_used($leek, $fight, $equip_id, $connection) {
      $equip_id_list = get_value_from_users("equipment", $connection);
      $equip_id_array = explode(",", $equip_id_list);
      $i = 0;
      foreach ($equip_id_array as $equip) {
      	      if ($equip == $equip_id) {
	      	 if (is_weapon($equip_id, $connection)) {
		    $weapon_id = get_weapon_id($equip_id, $connection);
		    if ($fight) {
		       player_attack($leek, $weapon_id, $connection);
		    }
		 } else {
		    $equip_name = get_value_for_equip_id("name", $equip_id, $connection);
		    if ($equip_name == "first aid kit") {
		       $hp = get_value_from_users("hp", $connection);
		       if ($hp < default_health()) {
		       	  $hp = $hp + 1;
			  update_users("hp", $hp, $connection);
		       }
		    }
		 }

	      	 $uses_list = get_value_from_users("uses", $connection);
	      	 $uses_array = explode(",", $uses_list);
		 $use = $uses_array[$i];
		 if ($use > 0 && $use < 500) {
	 		 $use2 = $use - 1;
	 		 $uses_array[$i] = $use2;
			 $new_uses_list =  join(",", $uses_array);
	 		 update_users("uses", $new_uses_list, $connection);
			 return 1;
		} else if ($use > 500) {
		  return 1;
		} else {
		  return 0;
		}
      	      }
	      	$i++; 	 
      }
}

function is_weapon($equip_id, $connection) {
  $sql = "SELECT *  FROM weapons WHERE equip_id = '{$equip_id}'";

  if (!$result = mysql_query($sql, $connection)) 
      showerror();
  
  if (mysql_num_rows($result) != 1)
      return 0;
  else {
       return 1;
  }

}



function add_equipment($equip, $connection) {
   if (! check_for_equipment($equip, $connection)) {
      $equip_id = get_value_for_name_from("equip_id", "equipment", $equip, $connection);
      $default_uses = get_value_for_name_from("default_uses", "equipment", $equip, $connection);
      $equip_id_list = get_value_from_users("equipment", $connection);
      if (is_null($equip_id_list) || $equip_id_list == "") {
      	 $new_equip_id_list = $equip_id;
	 $uses = $default_uses;
      } else {
         $new_equip_id_list = $equip_id_list . "," . $equip_id;
	 $uses_list = get_value_from_users("uses", $connection);
	 $uses = $uses_list . "," . $default_uses;
      }    	
      update_users("equipment", $new_equip_id_list, $connection);
      update_users("uses", $uses, $connection);
   } else {
      $equip_id_list = get_value_from_users("equipment", $connection);
      $equip_id = get_value_for_name_from("equip_id", "equipment", $equip, $connection);
      $default_uses = get_value_for_name_from("default_uses", "equipment", $equip, $connection);
      if ($default_uses < 500) {
      	 $uses_list = get_value_from_users("uses", $connection);
      	 $uses_array = explode(",", $uses_list);
         $equip_id_array = explode(",", $equip_id_list);
	 $i = 0;
	 foreach ($equip_id_array as $eq) {
	     if ($eq == $equip_id) {
	       	 $use = $uses_array[$i];
		 $new_use = $use + $default_uses;
		 if ($new_use > 100) {
		    $new_use = 100;
		 }
		 $uses_array[$i] = $new_use;
         	 $new_uses_list =  join(",", $uses_array);
	  	 update_users("uses", $new_uses_list, $connection);
	     }
	     $i = $i + 1;
	 }
      }
   }
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