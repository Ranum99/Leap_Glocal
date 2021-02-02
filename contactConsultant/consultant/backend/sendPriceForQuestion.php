<?php
    include_once '../../../backend/db.php';
    include_once '../../../global/global.php';
    include_once '../../../backend/session.php';

    // Checking if every post is not empty and existing
    if (!existAndNotEmpty_post("questionId") ||
        !existAndNotEmpty_post("price")) {
        goback();
    }

    $questionId = $_POST["questionId"];
    $price = $_POST["price"];
    $userIdMe = $_SESSION['userdata']->__get('id_user');

    // Inserting answer into DB
    $stmtInsertAnswerToDB = "INSERT INTO consultant_answer_job (id_question_to_consultant, price, id_consultant)
                             VALUES (?, ?, ?)";
    $stmtInsertAnswerToDB = $conn->prepare($stmtInsertAnswerToDB);
    $stmtInsertAnswerToDB->bind_param('sss', $questionId, $price, $userIdMe);
    $stmtInsertAnswerToDB->execute();
    $stmtInsertAnswerToDB->close();

    // Going back index
    header('LOCATION: ../index.php');
