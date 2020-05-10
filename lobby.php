<?php 
/*require 'depends/db.php';

//query from the database
$players = $db -> prepare("SELECT * FROM GamePLayers WHERE GameID = ?");
$placeholders = [
    $_SESSION['GameID']
]; 
$players->execute($placeholders);

$numberofplayers = $players->rowCount();

echo '<script src="depends/getnumberofplayers.js"></script>'*/

    session_start();
    
    require 'db.php';
    
    $gamecode = $_SESSION['gamecode'];

    echo 'Hello welcome to the lobby';
    
    echo '<br />';
    
    echo 'game code is: ' .$gamecode;
    
    $query = "SELECT `GameId` FROM `Games` WHERE `GameCode` = '$gamecode'";
    
    $statement = $db -> prepare($query);
                
    $statement -> execute();
    
    $gameidhold = $statement -> fetch(PDO::FETCH_ASSOC);
        
    $gameid = $gameidhold["GameId"];
    
    echo '<br />';
    
    echo $gameid;
    
    echo '<br />';
    
    $query1 = "SELECT Players.PlayerId FROM Players LEFT JOIN GamePlayers ON Players.PlayerId = GamePlayers.PlayerId WHERE GameId = '$gameid'";
    
    $statement1 = $db -> prepare($query1);
    
    $statement1 -> execute();
    
    $playerid = array();

    while ($row = $statement1->fetch(PDO::FETCH_ASSOC)){
        
        $playerid[] = $row;
        
    }
    
    print_r($playerid);
    
    $playerid1 = join("','",$playerid);
    
    //TRYING TO TAKE ALL PLAYER IDS BASED ON GAME ID AND THEN LINK IT TO NAMES AND PUT IT IN TABLE
    
    //player ids based on game id seems to work but im having trouble with arrays
    
    $query2 = "SELECT `Name` FROM `Players` WHERE PlayerId IN ('$playerid1')";
    
    $statement2 = $db -> prepare($query2);
    
    $statement2 -> execute();
    
    echo '<br />';
    
    echo 'GAME ID DISPLAY AND PLAYER ID DISPLAY ARE TEMP FOR TESTING';
    
    echo '<br>';
            
    echo '<center>';
            
        echo '<table style= "width:90%" class= "table table-striped">';
                    
            echo '<thead>';
                        
                echo '<tr>';
                        
                    echo '<th> Player Name </th>';
                            
                echo '</tr>';
                    
            echo '</thead>';
                    
            while ($row1 = $statement2->fetch(PDO::FETCH_ASSOC)) {
                
                echo '<tr><td>'. $row['Name'] .'</td></tr>';
                
            }
            
        echo '</table>';
                
    echo '</center>';
    
    echo $gameid;

?>

?>