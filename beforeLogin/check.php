<?php

    $typeBruker_post = $_POST["typeOfUser"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    //TODO: KRYPTERE PASSORD

    /* SJEKKE OM MAIL OG TYPE BRUKER FINNES I DATABASE
        HVIS JA: SENDES TILBAKE OG FÅR BESKJED

    REGISTRERE BRUKER I DATABASE OG BLIR SENDT VIDERE TIL BETALINGSSIDE
        LAGRE PASSORD MED SALT*/
