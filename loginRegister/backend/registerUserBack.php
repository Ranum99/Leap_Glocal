<?php
    include_once '../../backend/db.php';
    include_once '../../global/global.php';

    $telephone_post = null;
    $specification_post = null;
    $description_post = null;
    $webURL_post = null;
    $postalCode_post = null;
    $place_post = null;
    $address_post = null;
    $orgnumber_post = null;
    $age_post = null;
    $levelOfXp_post = null;

    $requiredColumnsFilled = 0; // Kanskje bruke session
    $rating1to5 = 0;
    $ratingNumberOfVoters = 0;

    switch ($_SESSION['typeOfUser']) {
        case 1: //COMPANY
            $postNameArray = array("telephone", "specification", "description", "postalCode", "place", "address", "orgnumber");
            for ($i = 0; $i < sizeof($postNameArray); $i++)
                if (!existAndNotEmpty_post($postNameArray[$i]))
                    goback();
            if (existAndNotEmpty_post("webURL"))
                $webURL_post = $_POST["webURL"];
            // Gjør noe
            break;
        case 2: // CONSULTANT
            $postNameArray = array("telephone", "specification", "description", "webURL", "age", "levelOfXp");
            // Gjør noe
            break;
        case 3: // Normal user
            $postNameArray = array("telephone", "specification", "age");
            // Gjør noe
            break;
    }


    // Gå gjennom alle felter og se at alt er fylt ut
        // $requiredColumnsFilled = 1;

echo 'TYPE BRUKER: '.$typeUser_post.'<br>';
echo 'EMAIL: '.$email_post.'<br>';
echo 'NAVN: '.$name_post.'<br>';
echo 'PASSORD: '.$password_post.'<br>';
echo 'PASSORD IGJEN: '.$repeatPassword_post.'<br>';
echo 'PASSORD HASH: '.$hashPassword.'<br>';