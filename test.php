<?php

    //game id auto incriment 

    //switch statement 

    //case for different parts (create player ect)

    //or maybe split it up into different pages

    //or split into pages and use include to put them into a switch statement 

    //create something that will generate question/answer ids with a game 

    //link those ids to the bank of questions/answers

    //Room keys for game? (not too sure how erik did it)

    //a way to chedk the players answer if it is correct or not

    //point system for when that happens

    //a way to have players interacting with eachother 

    //maybe a timer of 30 seconds then it shows the players answers and total points (maybe colors to show if they got it right or not?)

    //possibly a way to detect if all players have answered and if so it skips the 30 second timer

    //some kind of lobby for players to join in

    //MAYBE a way to kick players

    /* 

    create a game

        sql AI for game id

        game code random generated 

        current time for time started

    game answers

        connect game id with the one above

        im not too sure on how to generate the question id/answer thing

        connect question id question bank/same with answerid

    */

    $username = 'team2_2';
    
    $password = 'TPH5zOSt]&oY';
    
    $db = new PDO('mysql:host=localhost;dbname=team2_trivia', $username, $password);
    
    $gamecode = uniqid();

    $insert = "INSERT INTO `Games` (`GameCode`) VALUES ('$gamecode')";

    $statement = $db -> prepare($insert);
                
    $statement -> execute();
    
    echo $gamecode;
    
    $query = "SELECT `GameId` FROM `Games` WHERE `GameCode` = '$gamecode'";
    
    $statement1 = $db -> prepare($query);
                
    $statement1 -> execute();
    
    $gameidhold = $statement1 -> fetch(PDO::FETCH_ASSOC);
        
    $gameid = $gameidhold["GameId"];
    
    echo '<br />';
    
    echo $gameid;

    $numberofquestions = 5;

    for ($i = 1; $i <= $numberofquestions; $i++){
        
        $query1 ="INSERT INTO `GameAnswers` (GameId, QuestionId) VALUES ('". $gameid ."', '". $i ."')";
        
        $statement2 = $db -> prepare($query1);
                
        $statement2 -> execute();

    };
    
    /*foreach ($questionid as $row) {
        
        echo $row;
        
        $hold = $questionid[$row];
        
        $query1 ="INSERT INTO `GameAnswers` (GameId, QuestionId) VALUES ('". $gameid ."', '". $hold ."')";
        
        $statement2 = $db -> prepare($query1);
                
        $statement2 -> execute();
        
    }*/
    
    echo '<br />';
    
    print_r($questionid);

?>