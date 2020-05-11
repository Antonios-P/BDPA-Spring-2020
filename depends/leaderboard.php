<?php 
require 'db.php';

$i = 1;

$score = $db -> prepare("SELECT PlayerScore FROM GamePlayers ORDER BY PlayerScore DESC LIMIT 5");
$score -> execute();

echo '<table style="color: white;" class="games" align="center" width=auto border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <th> <font face="Arial">Place</font> </th>
          <th> <font face="Arial">Score</font> </th>
      </tr>';

while ($row = $score->fetch(PDO::FETCH_ASSOC)) {
    $field1name = $row["PlayerScore"];

    echo '<tr> 
            <td>'.$i.'</td>
            <td>'.$field1name.'</td>
          </tr>';

    $i++;
}


?>