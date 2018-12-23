<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(42, $db);
    add_location_clue(42,$db);

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
<img src=assets/location42.png>
<h2>The Devil's Crowll</h2>

<i><p>The entrance was located at the base of a low cliff in one of the many scowles after which this particular part of the Forest was named. Depressions left by ancient outcrop workings, the name coming maybe from the Welsh word ysgil, meaning recess, or maybe from the Old English crowll, for cave. No-one could say for sure.</p>

<p>And no-one could say where this particular name had come from either, but what they did know was that of all the workings in the area, this was undoubtedly the oldest. The hammer-stones of the Iron Age had first helped men gouge and break the ore from the rocks here. The Romans followed and deepened the workings, digging down and ever down, throwing up their slag heaps onto the surface, far and wide, like an army of busy, untidy moles. Attracted to the area by the presence of the yew trees, so often found inextricably linked with the prized iron ore.</p>

<p>The entrance was guarded now by a stainless steel gate, secured with a heavy padlock. Lyle had the key in his hand as he and the others headed up the muddy track. Determined not to waste any time, they’d gone equipped with basic rescue gear, a drag-sheet which could be used to carry a casualty if needed and various other items of emergency kit. And because Lyle wasn’t the type to take chances, he and Ditzy both carried their M4s. They were stowed inside modified tackle bags, so he hoped the rifles wouldn’t be needed in too much of a hurry, but he preferred to be safe rather than sorry. And alive rather than dead.</p></i>

<p>Someone has scratched something into the wall by the gate:  <img src=assets/clue42.png></p></i>

<?php
    add_fanfic(48,$db);
    print "<p>Now Read On:</p>";
    print_fanfic(48,$db);
    print_travel(42,$db);
    print_footer(42,$db);
    ?>

</div>
</body>
</html>
