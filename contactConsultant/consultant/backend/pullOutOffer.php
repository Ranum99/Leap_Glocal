<?php
    include_once '\xampp\htdocs\skole\leap-glocal\backend\db.php';
    include_once '\xampp\htdocs\skole\leap-glocal\global\global.php';
    include_once '\xampp\htdocs\skole\leap-glocal\backend\session.php';

    if (!isset($_GET['job']) || empty($_GET['job']))
        return;

    $jobId = $_GET['job'];

    echo 'Update job '.$jobId.' - DELETE';

    $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

    $stmtGetAllQuestionForUser = "DELETE FROM consultant_answer_job 
                                      WHERE id_consultant_answer_job = ?;";
    $stmtGetAllQuestionForUser = $connen->prepare($stmtGetAllQuestionForUser);
    $stmtGetAllQuestionForUser->bind_param('s', $jobId);
    $stmtGetAllQuestionForUser->execute();

    header('Location: ../index.php');
