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

    $datasource = 'mysql:host=localhost;dbname=team2_trivia';
    
    $dusername = 'team2_2';
    
    $dpassword = 'TPH5zOSt]&oY';
            
    $pdo = new PDO($datasource, $dusername, $dpassword);

    $gamecode = uniqid();

    $insert = "INSERT INTO `Games` (`GameCode`) VALUES ('$gamecode')";

    $statement = $pdo -> prepare($insert);
                
    $statement -> execute();

?>