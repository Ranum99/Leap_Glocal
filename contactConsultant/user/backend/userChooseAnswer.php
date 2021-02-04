<?php
    include_once '\xampp\htdocs\skole\leap-glocal\backend\db.php';
    include_once '\xampp\htdocs\skole\leap-glocal\global\global.php';
    include_once '\xampp\htdocs\skole\leap-glocal\backend\session.php';

    if (!isset($_GET['question']) || empty($_GET['question']))
        return;

    if (!isset($_GET['answer']) || empty($_GET['answer']))
        return;

    $questionId = $_GET['question'];
    $answerId = $_GET['answer'];

    echo 'Update question '.$questionId.' isAnswered to '.$answerId;

    $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

    $stmtGetAllQuestionForUser = "UPDATE question_to_consultant 
                                  SET isAnswered = ?
                                  WHERE id_question_to_consultant = ?;";
    $stmtGetAllQuestionForUser = $connen->prepare($stmtGetAllQuestionForUser);
    $stmtGetAllQuestionForUser->bind_param('ss', $answerId, $questionId);
    $stmtGetAllQuestionForUser->execute();

    //TODO: opprette en samtale med konsulenten man valgte, og bli sendt til samtalen

    header('Location: ../index.php');
