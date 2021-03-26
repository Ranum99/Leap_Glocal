<?php
    include_once '\xampp\htdocs\skole\leap-glocal\backend\db.php';
    include_once '\xampp\htdocs\skole\leap-glocal\global\global.php';
    include_once '\xampp\htdocs\skole\leap-glocal\backend\session.php';

    if (!isset($_GET['question']) || empty($_GET['question']))
        return;

    if (!isset($_GET['answer']) || empty($_GET['answer']))
        return;

    if (!isset($_GET['consultant']) || empty($_GET['consultant']))
        return;

    $questionId = $_GET['question'];
    $answerId = $_GET['answer'];
    $consultantId = $_GET['consultant'];

    echo 'Update question '.$questionId.' isAnswered to '.$answerId;

    $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

    $stmtGetAllQuestionForUser = "UPDATE question_to_consultant 
                                  SET isAnswered = ?
                                  WHERE id_question_to_consultant = ?;";
    $stmtGetAllQuestionForUser = $connen->prepare($stmtGetAllQuestionForUser);
    $stmtGetAllQuestionForUser->bind_param('ss', $answerId, $questionId);
    $stmtGetAllQuestionForUser->execute();

    $userMeId = $_SESSION['userdata']->__get('id_user');

    //TODO: opprette en samtale med konsulenten man valgte, og bli sendt til samtalen

    $conn = getDb();
    $stmtMakeConversation = "INSERT INTO conversation (userId, consultantId, questionId)
                             VALUES (?, ?, ?)";
    $stmtMakeConversation = $conn->prepare($stmtMakeConversation);
    $stmtMakeConversation->bind_param('sss', $userMeId, $consultantId, $questionId);
    $stmtMakeConversation->execute();


    header('Location: ../index.php');
