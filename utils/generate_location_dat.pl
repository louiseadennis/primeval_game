$i = 2;

for $d1  ('A' .. 'F') {
    for $d2 ('A', 'I', 'N', 'O', 'R', 'T') {
        for $d3 ('C', 'D', 'E', 'G', 'S', 'T') {
            unless ($d1 eq 'A' && $d2 eq 'R' && $d3 eq 'C') {
                print ("INSERT INTO `locations` VALUES (" . $i . ", '" . $d1 . "','" . $d2 . "','" . $d3 . "','Nothing Here Yet',0,0,NULL,0,'',0,0,0,'No Name Yet','No Clue Yet','No Era Yet');\n");
                $i++;
            }
        }
    }
}
