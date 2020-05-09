<?php

require 'bootstrap.php';

$methodName = $_GET['method'];
switch($methodName) {

    case 'join-game':
        $game = new Game($pdo);
        $player = new Player($pdo);
        
        $numberOfQuestion = $_POST['numberOfQuestions'];
        $name = $_POST['name'];
        $gameCode = $_POST['gameCode'];

        if ($numberOfQuestion) {
            $gameId = $game->create($numberOfQuestion);
        } else {
            $gameId = $game->getIdByGameCode($gameCode);
            if (!$gameId) {
                http_response_code(404);
                echo '{}';
                die();
            }
        }

        $playerId = $player->create($name);
        $game->addPlayerToGame($playerId, $gameId);

        $response = [
            'gameId' => $gameId,
            'gameCode' => $game->getGameCodeById($gameId),
            'playerId' => $playerId
        ];

        $_SESSION['playerId'] = $playerId;
        $_SESSION['gameId']   = $gameId;

        echo json_encode($response);
        break;

    case 'get-game':
        $game = new Game($pdo);

        $details = $game->getGameDetailsByCode($_POST['gameCode']);

        echo json_encode($details);
        break;

    case 'submit-answer':
        break;

    case 'game-results':
        break;

    default:
        http_response_code(404);
        echo '{}';
}