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

    function setSession_register($email, $name, $password, $typeOfUser) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['password'] = $password;
        $_SESSION['typeOfUser'] = $typeOfUser;
        $_SESSION['hasFilledAllColumns'] = 0;
        setIDSession();
    }

    function setFullSession() {
        include_once 'db.php';

        $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

        $stmtGetUserInfo = "SELECT id_user, name, requiredColumnsFilled FROM users
                                    WHERE email = ?
                                        AND typeOfUser = ?";
        $stmtGetUserInfo = $connen->prepare($stmtGetUserInfo);
        $stmtGetUserInfo->bind_param('ss', $_SESSION['email'], $_SESSION['typeOfUser']);
        $stmtGetUserInfo->execute();
        $stmtGetUserInfo->bind_result($idFromSQL, $nameFromSQL, $hasFilledAllColumns);
        $stmtGetUserInfo->store_result();

        if ($stmtGetUserInfo->num_rows === 1) {
            $stmtGetUserInfo->fetch();
            $_SESSION['idUser'] = $idFromSQL;
            $_SESSION['name'] = $nameFromSQL;
            $_SESSION['hasFilledAllColumns'] = $hasFilledAllColumns;
        }
    }

    function setSession_login($email, $password, $typeOfUser) {
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['typeOfUser'] = $typeOfUser;
        setFullSession();
    }

    //TODO: check if session is valid and if all required columns in DB is filled (can be one method)

    function validSession() {
        include_once 'db.php';

        $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

        $stmtCheckIfValidSESSION = "SELECT requiredColumnsFilled FROM users
                                            WHERE id_user = ?
                                                AND email = ?
                                                AND typeOfUser = ?;";
        $stmtCheckIfValidSESSION = $connen->prepare($stmtCheckIfValidSESSION);
        $stmtCheckIfValidSESSION->bind_param('sss', $_SESSION['idUser'], $_SESSION['email'], $_SESSION['typeOfUser']);
        $stmtCheckIfValidSESSION->execute();
        $stmtCheckIfValidSESSION->bind_result($hasFilledAllColumns);
        $stmtCheckIfValidSESSION->store_result();
        $stmtCheckIfValidSESSION->fetch();

        if ($stmtCheckIfValidSESSION->num_rows !== 1) {
            header('LOCATION: /skole/leap-glocal/backend/logout.php');
        }
    }
    if (sizeof($_SESSION) > 0) {
        validSession();
    }

    function getDataFromSessionColumn($column) {
        if (sizeof($_SESSION) > 0) {
            if (isset($_SESSION[''.$column.'']) && !empty($_SESSION[''.$column.'']))
                return $_SESSION[''.$column.''];
        }
    }