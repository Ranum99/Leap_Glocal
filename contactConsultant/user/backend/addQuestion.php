<?php
    include_once '../../../backend/db.php';
    include_once '../../../global/global.php';
    include_once '../../../backend/session.php';

    // Checking if every post is not empty and existing
    if (!existAndNotEmpty_post("specification") ||
        !existAndNotEmpty_post("heading") ||
        !existAndNotEmpty_post("question")) {
        goback();
    }

    $specification = $_POST["specification"];
    $heading = $_POST["heading"];
    $question = $_POST["question"];
    $userIdMe = $_SESSION['userdata']->__get('id_user');

    //TODO: kan bli gjort en sjekk før man sender inn om det er stilt noe samme spm. før

    echo 'KATEGORI: '.$specification.'<br>';
    echo 'TITTEL: '.$heading.'<br>';
    echo 'SPØRSMÅL: '.$question.'<br>';

    // Inserting question into DB
    $stmtInsertQuestionToDB = "INSERT INTO question_to_consultant (user_id_asked, id_specification, heading, question)
                               VALUES (?, ?, ?, ?)";
    $stmtInsertQuestionToDB = $conn->prepare($stmtInsertQuestionToDB);
    $stmtInsertQuestionToDB->bind_param('ssss', $userIdMe, $specification, $heading, $question);
    $stmtInsertQuestionToDB->execute();
    $stmtInsertQuestionToDB->close();

    // Going back to all questions for user
    header('LOCATION: ../index.php');