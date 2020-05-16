<link rel="stylesheet" type="text/css" href="style.css">

<?php 

require 'depends/db.php';

$result = "SELECT * FROM Games";
$statement = $db->prepare($result);
$statement->execute();

echo '<table style="color: white;" class="games" align="center" width=auto border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <th> <font face="Arial">Game ID</font> </th> 
          <th> <font face="Arial">Game Code</font> </th> 
          <th> <font face="Arial">Time Started</font> </th>
          <th> <font face="Arial"></font> </th> 
      </tr>';
 
    /* fetch associative array */
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $field1name = $row["GameId"];
        $field2name = $row["GameCode"];
        $field3name = $row["TimeStarted"];

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>
                    <form method="GET">
                    <input type="submit" value="Join Game">
                    <input type="hidden" value="<?php echo $field2name  ?>">
                    </form>
                  </td>
              </tr>';

    }

?>