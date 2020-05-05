<?php 

require 'db.php';

$result = "SELECT * FROM Games";
$result = $db->prepare($query);
 
if ($result = $db->execute()) {
 
    /* fetch associative array */
    while ($row = $result->FETCH_ASSOC()) {
        $field1name = $row["GameId"];
        $field2name = $row["GameCode"];
        $field3name = $row["TimeStarted"];
        $field4name = $row["GameDesc"];
    }
 
    /* free result set */
    $result->closeCursor();
}

?>