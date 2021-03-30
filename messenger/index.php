<?php
    include_once '../backend/session.php';
    if ( !isset($_GET['message']) || empty($_GET['message']) )
        header('LOCATION: http://localhost/skole/leap-glocal/');

    $conversationId = $_GET['message'];

    $header = null;
    $conversationPartner = null;
    $question = null;
    $userName = null;

    getConversationData($conversationId);

    $messageOutput = getMessages($conversationId);

    function getConversationData($conversationId) {
        include_once '../backend/db.php';
        global $header;
        global $conversationPartner;
        global $question;
        global $userName;

        $conn = getDb();


        if ($_SESSION['userdata']->__get('typeOfUser') == 2)
            $stmt = "
                SELECT name, heading, user_id_asked, question FROM conversation AS C
                INNER JOIN question_to_consultant AS Q ON Q.id_question_to_consultant = C.questionId
                INNER JOIN users AS U ON U.id_user = Q.user_id_asked
                WHERE C.id = ?;
            ";
        else
            $stmt = "
                SELECT name, heading, consultantId, question FROM conversation AS C
                INNER JOIN question_to_consultant AS Q ON Q.id_question_to_consultant = C.questionId
                INNER JOIN users AS U ON U.id_user = C.consultantId
                WHERE C.id = ?;
            ";

        $stmt = $conn->prepare($stmt);
        $stmt->bind_param('s', $conversationId);
        $stmt->execute();
        $stmt->bind_result($userNameSQL, $headingSQL, $user_id_askedSQL, $questionSQL);
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->fetch();

            $header = $headingSQL;
            $conversationPartner = $user_id_askedSQL;
            $question = $questionSQL;
            $userName = $userNameSQL;
        }
    }

    function getMessages($conversationId) {
        include_once '../backend/db.php';

        $conn = getDb();

        $outputBuilder = '';

        $stmt = "
            SELECT message, userIdFrom from message
            WHERE conversationId = ?
        ";

        $stmt = $conn->prepare($stmt);
        $stmt->bind_param('s', $conversationId);
        $stmt->execute();
        $stmt->bind_result($message, $userIdFrom);
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $class = 'class="sent"';
                if ($userIdFrom != $_SESSION['userdata']->__get('id_user'))
                    $class = 'class="received"';
                $outputBuilder .= '<p '.$class.'>'.$message.'</p>';
            }
        }

        return $outputBuilder;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../global/common.css">
    <link rel="stylesheet" type="text/css" href="index.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="getMessages.js"></script>
    <script type="text/javascript" src="sendMessage.js"></script>

    <script src="https://kit.fontawesome.com/397d207bea.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- HERE COMES <NAV/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/nav.php"?>

    <main>
        <section>
            <div class="messengerHeader">
                <h1><?php echo $header; ?></h1>
                <a href="http://localhost/skole/leap-glocal/profile.php?user=<?php echo md5($conversationPartner); ?>" class="blueUnderlineBtn">Chat med <?php echo $userName; ?></a>
            </div>
            <div class="task">
                <p><span class="thickBoi">Oppdrag:</span> <?php echo $question; ?></p>
            </div>

            <div class="messages" id="messagesHere">
                <?php echo $messageOutput; ?>
            </div>

            <div class="sendingMessage">
                <form action="javascript:void(0);" method="get">
                    <label>
                        <textarea id="messageToSend" class="message"></textarea>
                    </label>
                    <button id="sendTheMessage" class="sendMessage"><i class="fas fa-paper-plane fa-2x"></i></button>
                </form>
            </div>
        </section>
    </main>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php //include_once "../partsOfWebsite/footer.php"?>
</body>
</html>