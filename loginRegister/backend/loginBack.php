<?php
    $error = "";
    $email = "";
    $password = "";
    $typeUser = "";

    if (sizeof($_POST) == 0) {
        $email = "";
        $password = "";
        return;
    }

    if ( !isset($_POST['email']) || empty($_POST['email']) ) {
        $email = "";
        $error = "Venligst fyll inn epost";
        return;
    }

    if ( !isset($_POST['password']) || empty($_POST['password']) ) {
        $email = $_POST['email'];
        $error = "Venligst fyll inn passord";
        return;
    }

    // Saving post as variables
    $typeUser_post = $_POST["typeOfUser"];
    $email_post = $_POST["email"];
    $email = $email_post;
    $password_post = $_POST["password"];

    $isValidUser = checkLogin($email_post, $typeUser_post, $password_post);

    if (!$isValidUser)
        $error = "Epost eller passord er feil";


    function checkLogin($email, $typeUser, $password) {
        include_once 'C:\xampp\htdocs\skole\leap-glocal\backend\db.php';
        $isValidUser = false;

        $conn = getDb();

        $stmtCheckIfUserExist = "SELECT name, password, requiredColumnsFilled FROM users 
                                 WHERE email = ? AND typeOfUser = ?";
        $stmtCheckIfUserExist = $conn->prepare($stmtCheckIfUserExist);
        $stmtCheckIfUserExist->bind_param('ss', $email, $typeUser);
        $stmtCheckIfUserExist->execute();
        $stmtCheckIfUserExist->bind_result($name_checkInSQL, $password_checkInSQL, $hasRequiredColumnsFilled);
        $stmtCheckIfUserExist->store_result();

        if ($stmtCheckIfUserExist->num_rows !== 1)
            return false;

        $stmtCheckIfUserExist->fetch();
        if (!password_verify($password, $password_checkInSQL))
            return false;

        // Setting session
        include_once 'C:\xampp\htdocs\skole\leap-glocal\backend\session.php';
        setSession_login($email, $password_checkInSQL, $typeUser);

        //TODO: en sjekk for å se om medlemskap har gått ut

        // Check if user have filled in all info for user type
            //If not: send to page to fill out form
        if ($hasRequiredColumnsFilled == 1)
            header('LOCATION: ../index.php');
        else
            header('LOCATION: registerUser.php');

        return $isValidUser;
    }






/*
echo 'TYPE OF USER: '.$typeUser_post.'<br>';
echo 'EMAIL: '.$email_post.'<br>';
echo 'PASSORD: '.$password_post.'<br>';
*/