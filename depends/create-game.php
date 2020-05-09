<?php

    $username = 'team2_2';
    
    $password = 'TPH5zOSt]&oY';
    
    $db = new PDO('mysql:host=localhost;dbname=team2_trivia', $username, $password);
    
    $gamecode = uniqid();

    $insert = "INSERT INTO `Games` (`GameCode`) VALUES ('$gamecode')";

    $statement = $db -> prepare($insert);
                
    $statement -> execute();
    
    $query = "SELECT `GameId` FROM `Games` WHERE `GameCode` = '$gamecode'";
    
    $statement1 = $db -> prepare($query);
                
    $statement1 -> execute();
    
    $gameidhold = $statement1 -> fetch(PDO::FETCH_ASSOC);
        
    $gameid = $gameidhold["GameId"];

    $numberofquestions = 2;
    
    $answerid = 1;

    for ($i = 1; $i <= $numberofquestions; $i++){
        
        for ($ii = 1; $ii <= 4; $ii++) {
            
            $query1 ="INSERT INTO `GameAnswers` (GameId, QuestionId, AnswerId) VALUES ('". $gameid ."', '". $i ."', '". $answerid ."')";
        
            $statement2 = $db -> prepare($query1);
                
            $statement2 -> execute();
            
            $answerid++;
            
        };

    };
    
    echo 'Use this Game Code to allow others to join: '.$gamecode.'.';
    echo '<br>';
    echo '<br>';
    echo 'The number of questions that you have selected is: '.$numberofquestions.'.';

?>