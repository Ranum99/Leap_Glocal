<?php
    session_start();

    // loginUserSession("contact@ranum.com","test123");

    function setIDSession() {
        include_once 'db.php';

        $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

        $stmtGetUserInfo = "SELECT id_user FROM users
                                WHERE email = ?
                                    AND typeOfUser = ?";
        $stmtGetUserInfo = $connen->prepare($stmtGetUserInfo);
        $stmtGetUserInfo->bind_param('ss', $_SESSION['email'], $_SESSION['typeOfUser']);
        $stmtGetUserInfo->execute();
        $stmtGetUserInfo->bind_result($idFromSQL);
        $stmtGetUserInfo->store_result();

        if ($stmtGetUserInfo->num_rows === 1) {
            $stmtGetUserInfo->fetch();
            $_SESSION['idUser'] = $idFromSQL;
        }
    }

    function loginUserSession_register($email, $name, $password, $typeOfUser) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['password'] = $password;
        $_SESSION['typeOfUser'] = $typeOfUser;
        setIDSession();
    }

    function validSession() {
        include_once 'db.php';

        $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

        $stmtCheckIfValidSESSION = "SELECT id FROM users
                                            WHERE id = ?
                                                AND email = ?
                                                AND password = md5(?);";
        $stmtCheckIfValidSESSION = $connen->prepare($stmtCheckIfValidSESSION);
        $stmtCheckIfValidSESSION->bind_param('sss', $_SESSION['idUser'], $_SESSION['email'], $_SESSION['password']);
        $stmtCheckIfValidSESSION->execute();
        $stmtCheckIfValidSESSION->bind_result($idUser_fromSQL_SESSION);
        $stmtCheckIfValidSESSION->store_result();
        $stmtCheckIfValidSESSION->fetch();

        if ($stmtCheckIfValidSESSION->num_rows !== 1) {
            header('LOCATION: ../../backend/logoutUser.php');
        }
    }