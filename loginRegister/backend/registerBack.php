<?php
    include_once '../../backend/db.php';
    include_once '../../global/global.php';

    // Checking if every post is not empty and existing
    if (!existAndNotEmpty_post("typeOfUser") ||
    !existAndNotEmpty_post("email") ||
    !existAndNotEmpty_post("name") ||
    !existAndNotEmpty_post("password") ||
    !existAndNotEmpty_post("repeatPassword")) {
        goback();
    }


    /*TODO: Sjekke mail og passord med regex
        også sjekke med js før innsendelse*/

    // Saving post as variables
    $typeUser_post = $_POST["typeOfUser"];
    $email_post = $_POST["email"];
    $name_post = $_POST["name"];
    $password_post = $_POST["password"];
    $repeatPassword_post = $_POST["repeatPassword"];
    $hashPassword = password_hash($password_post, PASSWORD_DEFAULT);


    // Checking if password are same
    if ($password_post != $repeatPassword_post)
        goback();


    // Checking if email and user type is already in the DB
    $stmtCheckIfUserExist = "SELECT password FROM users WHERE email = ? AND typeOfUser = ?";
    $stmtCheckIfUserExist = $conn->prepare($stmtCheckIfUserExist);
    $stmtCheckIfUserExist->bind_param('ss', $email_post, $typeUser_post);
    $stmtCheckIfUserExist->execute();
    $stmtCheckIfUserExist->bind_result($password_checkInSQL);
    $stmtCheckIfUserExist->store_result();

    if ($stmtCheckIfUserExist->num_rows > 0)
        goback();

    $stmtCheckIfUserExist->close();

    // Inserting userdata into DB
    $stmtInsertUserdataToDB = "INSERT INTO users (email, password, name, typeOfUser)
                             VALUES (?, ?, ?, ?)";
    $stmtInsertUserdataToDB = $conn->prepare($stmtInsertUserdataToDB);
    $stmtInsertUserdataToDB->bind_param('ssss', $email_post, $hashPassword, $name_post, $typeUser_post);
    $stmtInsertUserdataToDB->execute();
    $stmtInsertUserdataToDB->close();

    // Setting session
    include_once '../../backend/session.php';

    setSession_register($email_post, $name_post, $hashPassword, $typeUser_post);

    //TODO: go to new site where user can pay
        //TODO: meanwhile go to new site where user can fill out rest of info

    // Going to register rest of userdata
    header('LOCATION: ../registerUser.php');




/*
$typeUserString = array("Bedrift", "Konsulent", "Bruker");
echo 'TYPE BRUKER: '.$typeUser_post.' aka '.$typeUserString[$typeUser_post - 1].'<br>';
echo 'EMAIL: '.$email_post.'<br>';
echo 'NAVN: '.$name_post.'<br>';
echo 'PASSORD: '.$password_post.'<br>';
echo 'PASSORD IGJEN: '.$repeatPassword_post.'<br>';
echo 'PASSORD HASH: '.$hashPassword.'<br>';

if (password_verify('123', $hashPassword))
    echo 'Passordet er: 123 <br>';
else
    echo 'Passordet er IKKE: 321 <br>';
if (password_verify('321', $hashPassword))
    echo 'Passordet er: 321 <br>';
else
    echo 'Passordet er IKKE: 321 <br>';

SJEKKE OM MAIL OG TYPE BRUKER FINNES I DATABASE
    HVIS JA: SENDES TILBAKE OG FÅR BESKJED

REGISTRERE BRUKER I DATABASE OG BLIR SENDT VIDERE TIL BETALINGSSIDE
*/
