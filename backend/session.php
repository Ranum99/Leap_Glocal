<?php
    include 'E:\xampp\htdocs\skole\leap-glocal\User.php';
    session_start();


    // loginUserSession("contact@ranum.com","test123");

    function setRestOfSession_registerFull($telephone, $postalCode, $place, $address, $orgnumber, $rating1to5, $ratingNumberOfVoters, $specification, $levelOfXp, $webURL, $description, $age, $requiredColumnsFilled) {
        $_SESSION['userdata']->__set('phoneNumber', $telephone);
        $_SESSION['userdata']->__set('postalCode', $postalCode);
        $_SESSION['userdata']->__set('place', $place);
        $_SESSION['userdata']->__set('address', $address);
        $_SESSION['userdata']->__set('orgNumber', $orgnumber);
        $_SESSION['userdata']->__set('rating1to5', $rating1to5);
        $_SESSION['userdata']->__set('rating_numberOfVoters', $ratingNumberOfVoters);
        $_SESSION['userdata']->__set('specification', $specification);
        $_SESSION['userdata']->__set('levelOfExperience', $levelOfXp);
        $_SESSION['userdata']->__set('websiteURL', $webURL);
        $_SESSION['userdata']->__set('description', $description);
        $_SESSION['userdata']->__set('age', $age);
        $_SESSION['userdata']->__set('requiredColumnsFilled', $requiredColumnsFilled);
    }

    function setIDSession($user) {
        include_once 'db.php';

        $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

        $stmtGetUserInfo = "SELECT id_user FROM users
                                WHERE email = ?
                                    AND typeOfUser = ?";
        $stmtGetUserInfo = $connen->prepare($stmtGetUserInfo);
        $stmtGetUserInfo->bind_param('ss', $user->__get('email'), $user->__get('typeOfUser'));
        $stmtGetUserInfo->execute();
        $stmtGetUserInfo->bind_result($idFromSQL);
        $stmtGetUserInfo->store_result();

        if ($stmtGetUserInfo->num_rows === 1) {
            $stmtGetUserInfo->fetch();
            $user->__set('id_user', $idFromSQL);
            $_SESSION['userdata'] = $user;
        }
    }

    function setSession_register($email, $name, $password, $typeOfUser) {
        $user = new User();
        $user->__set('email', $email);
        $user->__set('name', $name);
        $user->__set('password', $password);
        $user->__set('typeOfUser', $typeOfUser);
        $user->__set('requiredColumnsFilled', 0);

        setIDSession($user);
    }

    function setFullSession($user) {
        include_once 'db.php';

        $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

        $stmtGetUserInfo = "SELECT id_user, name, phoneNumber, postalCode, place, address, orgNumber, rating1to5, rating_numberOfVoters, specification, levelOfExperience, websiteURL, description, userHasPaid, userLastPayment, durationOfLastPayment, age, requiredColumnsFilled FROM users
                                    WHERE email = ?
                                        AND typeOfUser = ?";
        $stmtGetUserInfo = $connen->prepare($stmtGetUserInfo);
        $stmtGetUserInfo->bind_param('ss', $user->__get('email'), $user->__get('typeOfUser'));
        $stmtGetUserInfo->execute();
        $stmtGetUserInfo->bind_result($idFromSQL, $nameFromSQL, $phoneNumberFromSQL, $postalCodeFromSQL, $placeFromSQL, $addressFromSQL, $orgNumberFromSQL, $rating1to5FromSQL, $rating_numberOfVotersFromSQL, $specificationFromSQL, $levelOfExperienceFromSQL, $websiteURLFromSQL, $descriptionFromSQL, $userHasPaidFromSQL, $userLastPaymentFromSQL, $durationOfLastPaymentFromSQL, $ageFromSQL, $requiredColumnsFilled);
        $stmtGetUserInfo->store_result();

        if ($stmtGetUserInfo->num_rows === 1) {
            $stmtGetUserInfo->fetch();
            $user->__set('id_user', $idFromSQL);
            $user->__set('name', $nameFromSQL);
            $user->__set('phoneNumber', $phoneNumberFromSQL);
            $user->__set('postalCode', $postalCodeFromSQL);
            $user->__set('place', $placeFromSQL);
            $user->__set('address', $addressFromSQL);
            $user->__set('orgNumber', $orgNumberFromSQL);
            $user->__set('rating1to5', $rating1to5FromSQL);
            $user->__set('rating_numberOfVoters', $rating_numberOfVotersFromSQL);
            $user->__set('specification', $specificationFromSQL);
            $user->__set('levelOfExperience', $levelOfExperienceFromSQL);
            $user->__set('websiteURL', $websiteURLFromSQL);
            $user->__set('description', $descriptionFromSQL);
            $user->__set('userHasPaid', $userHasPaidFromSQL);
            $user->__set('userLastPayment', $userLastPaymentFromSQL);
            $user->__set('durationOfLastPayment', $durationOfLastPaymentFromSQL);
            $user->__set('age', $ageFromSQL);
            $user->__set('requiredColumnsFilled', $requiredColumnsFilled);
            $_SESSION['userdata'] = $user;
        }
    }

    function setSession_login($email, $password, $typeOfUser) {
        $user = new User();
        $user->__set('email', $email);
        $user->__set('password', $password);
        $user->__set('typeOfUser', $typeOfUser);

        setFullSession($user);
    }

    //TODO: check if session is valid and if all required columns in DB is filled (can be one method)

    function validSession() {
        include_once 'db.php';

        $id_user = $_SESSION['userdata']->__get('id_user');
        $email = $_SESSION['userdata']->__get('email');
        $typeOfUser = $_SESSION['userdata']->__get('typeOfUser');

        $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

        $stmtCheckIfValidSESSION = "SELECT requiredColumnsFilled FROM users
                                            WHERE id_user = ?
                                                AND email = ?
                                                AND typeOfUser = ?;";
        $stmtCheckIfValidSESSION = $connen->prepare($stmtCheckIfValidSESSION);
        $stmtCheckIfValidSESSION->bind_param('sss', $id_user, $email, $typeOfUser);
        $stmtCheckIfValidSESSION->execute();
        $stmtCheckIfValidSESSION->bind_result($requiredColumnsFilled);
        $stmtCheckIfValidSESSION->store_result();
        $stmtCheckIfValidSESSION->fetch();

        if ($stmtCheckIfValidSESSION->num_rows !== 1) {
            header('LOCATION: /skole/leap-glocal/backend/logout.php');
        }
    }
    if (isset($_SESSION['userdata']) && sizeof($_SESSION) > 0) {
        validSession();
    }

    function getDataFromSessionColumn_userdata($column) {
        if (isset($_SESSION['userdata']) && sizeof($_SESSION) > 0) {
            if (isset($_SESSION['userdata']) && !empty($_SESSION['userdata']->__get(''.$column.'')))
                return $_SESSION['userdata']->__get(''.$column.'');
        }
        return null;
    }

    /*
    $_SESSION['lang'] = "eng";

    if (isset($_GET['lang']) && $_GET['lang'] == "nor") {
        $_SESSION['lang'] == "nor";
    }

    if (isset($_SESSION['lang'])) {
        if ($_SESSION['lang'] == "nor")
            include 'C:\xampp\htdocs\skole\leap-glocal\backend\languages\lang_nor.php';
        if ($_SESSION['lang'] == "eng")
            include 'C:\xampp\htdocs\skole\leap-glocal\backend\languages\lang_eng.php';
    } else {
        include 'C:\xampp\htdocs\skole\leap-glocal\backend\languages\lang_eng.php';
    }
    */