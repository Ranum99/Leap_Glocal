<?php
    include_once '../backend/session.php';
    if ( !isset($_POST['conversation']) || empty($_POST['conversation']) )
        return;
    if ( !isset($_POST['message']) || empty($_POST['message']) )
        return;

    $conversationId = $_POST['conversation'];
    //$conversationId = 1;
    $message = $_POST['message'];
    //$message = 'lol';
    $userMeId = $_SESSION['userdata']->__get('id_user');

    include_once '../backend/db.php';

    $conn = getDb();

    $outputBuilder = '';

    $stmt = "
        INSERT INTO message (conversationId, message, userIdFrom, timeSent)
        VALUES (?, ?, ?, now())
    ";


    $returnValue = '';

    $stmt = $conn->prepare($stmt);
    $stmt->bind_param('sss', $conversationId, $message, $userMeId);
    if ($stmt->execute()) {
        $returnValue = '200';
    } else {
        $returnValue = '201';
    }

    echo $returnValue;

    $stmt->close();