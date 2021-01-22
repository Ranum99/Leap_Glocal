<?php
    include_once '../../backend/db.php';
    include_once '../../global/global.php';

    // Checking if every post is not empty and existing
    if (!existAndNotEmpty_post("typeOfUser") ||
        !existAndNotEmpty_post("email") ||
        !existAndNotEmpty_post("password")) {
        goback();
    }

    // Saving post as variables
    $typeUser_post = $_POST["typeOfUser"];
    $email_post = $_POST["email"];
    $password_post = $_POST["password"];

    // Checking if email and user type is in the DB
    $stmtCheckIfUserExist = "SELECT name, password FROM users WHERE email = ? AND typeOfUser = ?";
    $stmtCheckIfUserExist = $conn->prepare($stmtCheckIfUserExist);
    $stmtCheckIfUserExist->bind_param('ss', $email_post, $typeUser_post);
    $stmtCheckIfUserExist->execute();
    $stmtCheckIfUserExist->bind_result($name_checkInSQL, $password_checkInSQL);
    $stmtCheckIfUserExist->store_result();

    // Checks if query is true
    if ($stmtCheckIfUserExist->num_rows !== 1)
        goback();

    $stmtCheckIfUserExist->fetch();
    // Checks if password is correct
    if (!password_verify($password_post, $password_checkInSQL))
        goback();

    // Setting session
    include_once '../../backend/session.php';

    //TODO: check if user have filled in all info for user type
        //If not: send to page to fill out form

    setSession_login($email_post, $password_checkInSQL, $typeUser_post);

    // Going back to main
    header('LOCATION: ../../index.php');







echo 'TYPE OF USER: '.$typeUser_post.'<br>';
echo 'EMAIL: '.$email_post.'<br>';
echo 'PASSORD: '.$password_post.'<br>';