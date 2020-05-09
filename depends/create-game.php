<?php

    require 'db.php';
    
    //add the game
    $gamecode = uniqid();

    $insert = "INSERT INTO `Games` (`GameCode`) VALUES ('$gamecode')";

    $statement = $db -> prepare($insert);
                
    $statement -> execute();
    
    $query = "SELECT `GameId` FROM `Games` WHERE `GameCode` = '$gamecode'";
    
    $statement1 = $db -> prepare($query);
                
    $statement1 -> execute();
    
    $gameidhold = $statement1 -> fetch(PDO::FETCH_ASSOC);
        
    $gameid = $gameidhold["GameId"];

    $numberofquestions = $_POST['numberofquestions'];
    
    $answerid = 1;

    for ($i = 1; $i <= $numberofquestions; $i++){
        
        for ($ii = 1; $ii <= 4; $ii++) {
            
            $query1 ="INSERT INTO `GameAnswers` (GameId, QuestionId, AnswerId) VALUES ('". $gameid ."', '". $i ."', '". $answerid ."')";
        
            $statement2 = $db -> prepare($query1);
                
            $statement2 -> execute();
            
            $answerid++;
            
        };

    };

    //add the player
    //$gameid = $db -> prepare("SELECT ");

    //$playerid= 

    $name = $_POST['dispname']; //player name from form

    $insert1 = "INSERT INTO `Players` (`Name`) VALUES ('$name')";

    $statement3 = $db -> prepare($insert1);
                
    $statement3 -> execute();

    $query2 = "SELECT `PlayerId` FROM `Players` WHERE `Name` = '$name'";

    $statement4 = $db -> prepare($query2);
                
    $statement4 -> execute();

    $playeridhold = $statement4 -> fetch(PDO::FETCH_ASSOC);

    $playerid = $playeridhold['PlayerId'];

    $insert2 = "INSERT INTO `GamePlayers (`GameId`, `PlayerId`, `PlayerScore` VALUES ('$gameid', '$playerid', '0')";

    $statement5 = $db -> prepare($insert2);
                
    $statement5 -> execute();

    
    echo 'Use this Game Code to allow others to join: '.$gamecode.'.';
    echo '<br>';
    echo '<br>';
    echo 'The number of questions that you have selected is: '.$numberofquestions.'.';

?>