<link rel="stylesheet" type="text/css" href="style.css">

<?php 
require 'db.php';

//Get the top 5 players' score
$score = $db -> prepare("SELECT * FROM GamePlayers WHERE GameId = ? ORDER BY PlayerScore DESC LIMIT 5"); //This will select players from all the games. gameID will need to be used to only show players from current game.
$placeholders = [
    $_SESSION['GameId']
];
$score -> execute($placeholders);

//Get the top 5 players' display names
$player = $db -> prepare("SELECT Name FROM Players LEFT JOIN GamePlayers ON Players.PlayerId=GamePlayers.PlayerId ORDER BY PlayerScore DESC LIMIT 5"); /*The players still will get queried for every game regardless of the current game. The gameID will need to be used to only show the players from the currrent game.*/
$player->execute();

echo '<div id="container">';

echo '<table style="color: white;" class="games" align="center" width=auto border="0" cellspacing="2" cellpadding="2">'; 
echo '<div class="row">';
    echo '
      <tr> 
          <th> <font face="Arial">Place</font> </th>
          <th> <font face="Arial">Score</font> </th>
      </tr>';
echo '</div>';

while ($rowScore = $score->fetch(PDO::FETCH_ASSOC) and $rowPlayer = $player->fetch(PDO::FETCH_ASSOC)) {
    $score = $rowScore["PlayerScore"];
    $player = $rowPlayer["Name"]; /*The player name goes inside the quotes. This will have to be queried in accordance with the player ID that is in the game. A join (OUTER or INNER) will most likely have to be performed to get that data.*/;

   echo '<div class="row">
            <div class="name">'.$player.'</div><div class="score">'.$score.'</div>
         </div>';
}

echo '</div>';


?>