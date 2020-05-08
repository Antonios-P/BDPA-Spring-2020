<link rel="stylesheet" type="text/css" href="style.css">
<script src="depends/strobe.js"></script>

<?php 

require 'depends/db.php';

$result = "SELECT * FROM Games";
$statement = $db->prepare($result);
$statement->execute();

echo '<table align="center" width=auto border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <th> <font face="Arial">Game ID</font> </th> 
          <th> <font face="Arial">Game Code</font> </th> 
          <th> <font face="Arial">Time Started</font> </th> 
          <th> <font face="Arial">Description</font> </th>
          <th> <font face="Arial"></font> </th> 
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
                  <td>
                    <form method="GET">
                    <input type="submit" value="Join Game">
                    <input type="hidden" value="<?php  $field2name  ?>">
                    </form>
                  </td>
              </tr>';

    }
 
    /* free result set */
    $result->closeCursor();

?>