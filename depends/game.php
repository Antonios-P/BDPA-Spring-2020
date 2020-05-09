<?php

/*
CREATE TABLE `Games` (
  `GameId` int(11) NOT NULL,
  `GameCode` varchar(50) NOT NULL,
  `TimeStarted` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
*/
class Game {

    private $pdo;

    private $secondsToAnswerQuestion = 60;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function create($numberOfQuestions) {
        $now = time();

        $sql = "INSERT INTO Games (GameCode, TimeStarted) VALUES (?, ?)";
        $statement = $this->pdo->prepare($sql);
        $arguments = [
            uniqid(),
            $now
        ];
        if (!$statement->execute($arguments)) {
            return null;
        }
        $gameId = $this->pdo->lastInsertId();


        // Collect question ids
        $sql = "SELECT QuestionId FROM Questions ORDER BY rand() LIMIT {$numberOfQuestions}";
        $statement = $this->pdo->prepare($sql);
        if (!$statement->execute()) {
            return null;
        }
        $questionIds = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $questionIds[] = $row['QuestionId'];
        }

        // Add those question ids to the GameQuestions table
        $timeAsked = $now + $this->secondsToAnswerQuestion;
        $sql = "INSERT INTO GameQuestions (GameId, QuestionId, TimeAsked) VALUES (?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        foreach ($questionIds as $id) {
            $arguments = [
                $gameId,
                $id,
                $timeAsked
            ];
            $statement->execute($arguments);
            $timeAsked = $timeAsked + $this->secondsToAnswerQuestion;
        }
        

        // Get the correct answers for questions
        // Step 1: Where I add the correct answers
        $sql = "SELECT AnswerId, QuestionId FROM Answers WHERE Correct = 1 AND QuestionId IN (" . implode(',', $questionIds) . ")";
        $statement = $this->pdo->prepare($sql);
        if (!$statement->execute()) {
            return null;
        }
        $correctAnswerIds = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $correctAnswerIds[$row['QuestionId']] = $row['AnswerId'];
        }

        $sql = "INSERT INTO GameAnswers (GameId, QuestionId, AnswerId) VALUES (?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        foreach ($correctAnswerIds as $questionId => $answerId) {
            $arguments = [
                $gameId,
                $questionId,
                $answerId
            ];
            $statement->execute($arguments);
        }
        

        // Step 2: Where I add random incorrect answers
        foreach ($questionIds as $questionId) {
            $sql = "SELECT AnswerId FROM Answers WHERE Correct = 0 AND QuestionId = ? ORDER BY rand() LIMIT 3";
            $statement = $this->pdo->prepare($sql);
            if (!$statement->execute([$questionId])) {
                return null;
            }

            $incorrectAnswerIds = [];
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $incorrectAnswerIds[] = $row['AnswerId'];
            }

            $sql = "INSERT INTO GameAnswers (GameId, QuestionId, AnswerId) VALUES (?, ?, ?)";
            $statement = $this->pdo->prepare($sql);
            foreach ($incorrectAnswerIds as $answerId) {
                $arguments = [
                    $gameId,
                    $questionId,
                    $answerId
                ];
                $statement->execute($arguments);
            }
        }

        return $gameId;
    }

    function getIdByGameCode($gameCode) {
        $sql = "SELECT GameId FROM Games WHERE GameCode = ?";
        $statement = $this->pdo->prepare($sql);
        $arguments = [
            $gameCode
        ];
        
        if (!$statement->execute($arguments)) {
            return null;
        }        

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return $row['GameId'];
        }

        return false;
    }
    
    function getGameCodeById($gameId) {
        $sql = "SELECT GameCode FROM Games WHERE GameId = ?";
        $statement = $this->pdo->prepare($sql);
        $arguments = [
            $gameId
        ];
        
        if (!$statement->execute($arguments)) {
            return null;
        }        

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return $row['GameCode'];
        }

        return false;
    }

    function addPlayerToGame($playerId, $gameId) {
        $sql = "INSERT INTO GamePlayers (GameId, PlayerId, PlayerScore) VALUES (?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        $arguments = [
            $gameId,
            $playerId,
            0
        ];

        if (!$statement->execute($arguments)) {
            return false;
        }

        return true;
    }

    function getGameDetailsByCode($gameCode) {
        $gameId = $this->getIdByGameCode($gameCode);

        $returnData = [
            'CurrentQuestion' => 0,
            'StartTime' => 0,
            'EndTime' => 0,
            'PlayersInGame' => 0,
            'QuestionsRemaining' => 0
        ];

        $sql = "SELECT * FROM GamePlayers WHERE GameId = ?";
        $statement = $this->pdo->prepare($sql);
        $arguments = [
            $gameId
        ];

        $statement->execute($arguments);
        $returnData['PlayersInGame'] = $statement->rowCount();

        $sql = "SELECT * FROM GameQuestions WHERE GameId = ?, TimeAsked > ?";
        $statement = $this->pdo->prepare($sql);
        $arguments = [
            $gameId,
            time()
        ];

        $statement->execute($arguments);
        $returnData['QuestionsRemaining'] = $statement->rowCount();

        $sql = "SELECT * FROM GameQuestions WHERE GameId = ? ORDER BY TimeAsked";
        $statement = $this->pdo->prepare($sql);
        $arguments = [
            $gameId
        ];

        $statement->execute($arguments);
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            if ($row['TimeAsked'] <= time()) {
                $returnData['CurrentQuestionId'] = $row['QuestionId'];
                $returnData['StartTime'] = $row['TimeAsked'];
                $returnData['EndTime'] = $row['TimeAsked'] + $this->secondsToAnswerQuestion;
            }
        }

        return $returnData;
    }
    
}