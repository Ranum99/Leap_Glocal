<?php

    $typeUserString = array("Bedrift", "Konsulent", "Bruker");

    $typeUser_post = $_POST["typeOfUser"];
    $email_post = $_POST["email"];
    $name_post = $_POST["name"];
    $password_post = $_POST["password"];
    $repeatPassword_post = $_POST["repeatPassword"];

    $hashPassword = password_hash($password_post, PASSWORD_DEFAULT);

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

    //TODO: KRYPTERE PASSORD

    /* SJEKKE OM MAIL OG TYPE BRUKER FINNES I DATABASE
        HVIS JA: SENDES TILBAKE OG FÅR BESKJED

    REGISTRERE BRUKER I DATABASE OG BLIR SENDT VIDERE TIL BETALINGSSIDE
        LAGRE PASSORD MED SALT*/
