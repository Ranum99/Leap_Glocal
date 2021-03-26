<?php
    include_once '../backend/session.php';
    if ( !isset($_GET['conversation']) || empty($_GET['conversation']) )
        return;

    $timeNowTo = new DateTime('NOW');
    $timeNowFrom = $timeNowTo;

    include_once '../backend/db.php';

    $conn = getDb();

    $outputBuilder = '';

    $stmt = "
        SELECT message, userIdFrom FROM `message`
        WHERE timeSent BETWEEN ? AND ?
    ";

    $theTimeTo = $timeNowTo->format('Y-m-d H:i:s');
    $theTimeFrom = $timeNowFrom->modify('-1 second')->format('Y-m-d H:i:s');

    $stmt = $conn->prepare($stmt);
    $stmt->bind_param('ss', $theTimeFrom, $theTimeTo);
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

    echo $outputBuilder;
