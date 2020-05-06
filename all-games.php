<?php 

require 'db.php';

$result = "SELECT * FROM Games";
$statement = $db->prepare($query);
$statement->execute();

echo '<table align="center" width=auto border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">Game ID</font> </td> 
          <td> <font face="Arial">Game Code</font> </td> 
          <td> <font face="Arial">Time Started</font> </td> 
          <td> <font face="Arial">Description</font> </td> 
      </tr>';
 
    /* fetch associative array */
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $field1name = $row["GameId"];
        $field2name = $row["GameCode"];
        $field3name = $row["TimeStarted"];
        $field4name = $row["GameDesc"];

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
              </tr>';

    }
 
    /* free result set */
    $result->closeCursor();

?>