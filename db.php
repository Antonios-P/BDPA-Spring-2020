<?php
//connected.php
$username = 'p1001545_labs';
$password = '5O]JA%a7m4@J1Kyt';
$db = new PDO('mysql:host=localhost;dbname=p1001545_bank_loan2020', $username, $password);
$dbStmt = new PDOStatement('mysql:host=localhost;dbname=p1001545_bank_loan2020', $username, $password);