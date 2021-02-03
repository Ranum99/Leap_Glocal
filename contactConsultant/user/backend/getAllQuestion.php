<?php
    include_once '\xampp\htdocs\skole\leap-glocal\backend\db.php';
    include_once '\xampp\htdocs\skole\leap-glocal\global\global.php';
    include_once '\xampp\htdocs\skole\leap-glocal\backend\session.php';

    $userIdMe = $_SESSION['userdata']->__get('id_user');

    $output = '';

    $counter = 1;

    $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

    // Getting question and maybe answer from DB
    $stmtGetAllQuestionForUser = "SELECT id_question_to_consultant, id_specification, heading, question, isAnswered 
                                  FROM question_to_consultant 
                                  WHERE user_id_asked = ?
                                      AND isAnswered IS null";
    $stmtGetAllQuestionForUser = $connen->prepare($stmtGetAllQuestionForUser);
    $stmtGetAllQuestionForUser->bind_param('s', $userIdMe);
    $stmtGetAllQuestionForUser->execute();
    $stmtGetAllQuestionForUser->bind_result($id_questionFromSQL,$id_specificationFromSQL, $headingFromSQL, $questionFromSQL, $isAnswered);
    $stmtGetAllQuestionForUser->store_result();

    if ($stmtGetAllQuestionForUser->num_rows > 0) {
        while ($stmtGetAllQuestionForUser->fetch()) {
            $output .= '
                <article>
                    <div>
                        <h2>'.$headingFromSQL.'</h2>
                        <p>'.$questionFromSQL.'</p>
                    </div>
            ';

            $output .= getAllOffers($id_questionFromSQL);
            $output .= '</article>';

            $counter++;
        }
    } else
        goback();

    echo $output;


    function getAllOffers($id_question) {
        include_once '\xampp\htdocs\skole\leap-glocal\backend\db.php';

        $return = '';

        $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());
        // Getting all offers for question/help
        $stmtGetAllQuestionForUser = "SELECT id_consultant_answer_job, price, id_consultant, name FROM consultant_answer_job  
                                      INNER JOIN users ON id_consultant = id_user
                                      WHERE id_question_to_consultant = ?";
        $stmtGetAllQuestionForUser = $connen->prepare($stmtGetAllQuestionForUser);
        $stmtGetAllQuestionForUser->bind_param('s', $id_question);
        $stmtGetAllQuestionForUser->execute();
        $stmtGetAllQuestionForUser->bind_result($id_offerFromSQL, $priceFromSQL, $idConsultantFromSQL, $nameUserFromSQL);
        $stmtGetAllQuestionForUser->store_result();

        if ($stmtGetAllQuestionForUser->num_rows > 0) {
            $return .= '<ul>';
            while ($stmtGetAllQuestionForUser->fetch()) {
                $hassedUserId = urlencode(password_hash($idConsultantFromSQL, PASSWORD_DEFAULT));
                $return .= '<li value="'.$id_offerFromSQL.'"><div>'.$priceFromSQL.' kr from <a href="../../profile.php?user='.$hassedUserId.'">'.$nameUserFromSQL.'</a></div><a href="backend/userChooseAnswer.php?question='.$id_question.'&answer='.$id_offerFromSQL.'" class="asButton">Velg denne</a></li>';
            }
            $return .= '</ul>';
        } else
            $return = '<p>Ingen svar enda</p>';



        return $return;
    }