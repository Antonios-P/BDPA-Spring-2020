<?php 

require 'depends/db.php';

//query from the database
$players = $db -> prepare("SELECT * FROM GamePLayers WHERE GameID = ?");
$placeholders = [
    $_SESSION['GameID']
]; 
$players->execute($placeholders);

$numberofplayers = $players->rowCount();

echo 'Number of currently online players: <script src="depends/getnumberofplayers.js"></script>'

?>