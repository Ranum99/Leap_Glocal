<?php
    include_once '\xampp\htdocs\skole\leap-glocal\backend\db.php';
    include_once '\xampp\htdocs\skole\leap-glocal\global\global.php';
    include_once '\xampp\htdocs\skole\leap-glocal\backend\session.php';

    $userIdMe = $_SESSION['userdata']->__get('id_user');

    $output = '';

    $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

    // Getting question and maybe answer from DB
    $stmtGetAllQuestionForUser = "SELECT id_specification, heading, question, isAnswered 
                                  FROM question_to_consultant WHERE user_id_asked = ?";
    $stmtGetAllQuestionForUser = $connen->prepare($stmtGetAllQuestionForUser);
    $stmtGetAllQuestionForUser->bind_param('s', $userIdMe);
    $stmtGetAllQuestionForUser->execute();
    $stmtGetAllQuestionForUser->bind_result($id_specificationFromSQL, $headingFromSQL, $questionFromSQL, $isAnswered);
    $stmtGetAllQuestionForUser->store_result();

    if ($stmtGetAllQuestionForUser->num_rows > 0) {
        while ($stmtGetAllQuestionForUser->fetch()) {
            $output .= '
                <article>
                    <p>'.$headingFromSQL.'</p>
                    <p>'.$questionFromSQL.'</p>
            ';
            if ($isAnswered != null)
                $output .= '
                    <a href="" class="asButton">Se tilbud</a>
                ';
            $output .= '</article>';
        }
    } else
        goback();

    echo $output;