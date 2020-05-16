<?php 

    session_start();
    
    require 'depends/db.php';
    
    $gamecode = $_SESSION['gamecode'];

    echo 'Hello welcome to the lobby';
    
    echo '<br />';
    
    echo 'game code is: ' .$gamecode;
    
    $query = "SELECT `GameId` FROM `Games` WHERE `GameCode` = '$gamecode'";
    
    $statement = $db -> prepare($query);
                
    $statement -> execute();
    
    $gameidhold = $statement -> fetch(PDO::FETCH_ASSOC);
        
    $gameid = $gameidhold["GameId"];
    
    $query1 = "SELECT Name FROM Players LEFT JOIN GamePlayers ON Players.PlayerId = GamePlayers.PlayerId WHERE GameId = '$gameid'";
    
    $statement1 = $db -> prepare($query1);
    
    $statement1 -> execute();
    
    echo '<br />';
    
    echo '<br>';
            
    echo '<center>';
            
        echo '<table style= "width:90%" class= "table table-striped">';
                    
            echo '<thead>';
                        
                echo '<tr>';
                        
                    echo '<th> Player Name </th>';
                            
                echo '</tr>';
                    
            echo '</thead>';
                    
            while ($row = $statement1->fetch(PDO::FETCH_ASSOC)) {
                
                echo '<tr><td>'. $row['Name'] .'</td></tr>';
                
            }
            
        echo '</table>';
                
    echo '</center>';

?>