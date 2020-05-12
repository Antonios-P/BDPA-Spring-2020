<link rel="stylesheet" type="text/css" href="style.css">

<?php 
require 'db.php';

$score = $db -> prepare("SELECT * FROM GamePlayers ORDER BY PlayerScore DESC LIMIT 5");
$score -> execute();

echo '<div id="container">';

echo '<table style="color: white;" class="games" align="center" width=auto border="0" cellspacing="2" cellpadding="2">'; 
echo '<div class="row">';
    echo '
      <tr> 
          <th> <font face="Arial">Place</font> </th>
          <th> <font face="Arial">Score</font> </th>
      </tr>';
echo '</div>';

while ($row = $score->fetch(PDO::FETCH_ASSOC)) {
    $score = $row["PlayerScore"];
    $player = ""/*The player name goes inside the quotes. This will have to be queried in accordance with the player ID that is in the game. A join (OUTER or INNER) will most likely have to be performed to get that data.*/;

   echo '<div class="row">
            <div class="name">'.$player.'</div><div class="score">'.$score.'</div>
         </div>';
}

echo '</div>';


?>