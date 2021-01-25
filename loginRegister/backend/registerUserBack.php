<?php
    include_once '../../backend/db.php';
    include_once '../../backend/session.php';
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

    $requiredColumnsFilled = 0; // Kanskje bruke session???
    $rating1to5 = 0;
    $ratingNumberOfVoters = 0;

    //TODO: Sjekke forskjellige ting med regex og escape html-kode med mer fra beskrivelse og andre input

    // Setting rigyht values to variables
    switch ($_SESSION['userdata']->__get('typeOfUser')) {
        case 1: //COMPANY
            // Checking if required values for company form is filled
            $postNameArray = array("telephone", "specification", "description", "postalCode", "place", "address", "orgnumber");
            //if (!existAndNotEmpty_post_array($postNameArray))
                //goback();

            // Setting website url if filled
            if (existAndNotEmpty_post('webURL'))
                $webURL_post = $_POST['webURL'];

            // Setting variables
            $telephone_post = $_POST['telephone'];
            $specification_post = $_POST['specification'];
            $description_post = $_POST['description'];
            $postalCode_post = $_POST['postalCode'];
            $place_post = $_POST['place'];
            $address_post = $_POST['address'];
            $orgnumber_post = $_POST['orgnumber'];
            $requiredColumnsFilled = 1;
            break;
        case 2: // CONSULTANT
            // Checking if required values for consultant form is filled
            $postNameArray = array("telephone", "specification", "description", "age", "levelOfXp");
            //if (!existAndNotEmpty_post_array($postNameArray))
                //goback();

            // Setting website url if filled
            if (existAndNotEmpty_post('webURL'))
                $webURL_post = $_POST['webURL'];

            // Setting variables
            $telephone_post = $_POST['telephone'];
            $specification_post = $_POST['specification'];
            $description_post = $_POST['description'];
            $age_post = $_POST['age'];
            $levelOfXp_post = $_POST['levelOfXp'];
            $requiredColumnsFilled = 1;
            break;
        case 3: // Normal user
            // Checking if required values for consultant form is filled
            $postNameArray = array("telephone", "specification", "age");
            //if (!existAndNotEmpty_post_array($postNameArray))
                //goback();

            // Setting variables
            $telephone_post = $_POST['telephone'];
            $specification_post = $_POST['specification'];
            $age_post = $_POST['age'];
            $requiredColumnsFilled = 1;
            break;
    }

    $userId = $_SESSION['userdata']->__get('idUser');

    // Updating userdata in DB for user
    $stmtUpdateUserdataToDB = "UPDATE users SET
                               phoneNumber = ?,
                                   postalCode = ?,
                                   place = ?,
                                   address = ?,
                                   orgNumber = ?,
                                   rating1to5 = ?,
                                   rating_numberOfVoters = ?,
                                   specification = ?,
                                   levelOfExperience = ?,
                                   websiteURL = ?,
                                   description = ?,
                                   age = ?,
                                   requiredColumnsFilled = ?
                               WHERE id_user = ?";
    $stmtUpdateUserdataToDB = $conn->prepare($stmtUpdateUserdataToDB);
    $stmtUpdateUserdataToDB->bind_param('ssssssssssssss', $telephone_post, $postalCode_post, $place_post, $address_post, $orgnumber_post, $rating1to5, $ratingNumberOfVoters, $specification_post, $levelOfXp_post, $webURL_post, $description_post, $age_post, $requiredColumnsFilled, $userId);
    $stmtUpdateUserdataToDB->execute();
    $stmtUpdateUserdataToDB->close();

    //TODO: add to session
    setRestOfSession_registerFull($telephone_post, $postalCode_post, $place_post, $address_post, $orgnumber_post, $rating1to5, $ratingNumberOfVoters, $specification_post, $levelOfXp_post, $webURL_post, $description_post, $age_post, $requiredColumnsFilled);

    // Going back to main
    header('LOCATION: ../../index.php');
