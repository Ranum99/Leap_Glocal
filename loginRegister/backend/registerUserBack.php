<?php
    $error = "";

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

    $requiredColumnsFilled = 0;
    $rating1to5 = 0;
    $ratingNumberOfVoters = 0;

    //Update of DB
    $image_post = null;
    $country_post = null;
    $benefits_post = null;
    $numOfEmp_post = null;
    $gender_post = null;
    $industry_post = null;
    $startupPhase_post = null;
    $lookingFor_post = null;
    $businessModel_post = null;
    $title_post = null;

    //TODO: Sjekke forskjellige ting med regex og escape html-kode med mer fra beskrivelse og andre input

    if (sizeof($_POST) == 0) {
        return;
    }

    // Setting right values to variables

    switch ($_SESSION['userdata']->__get('typeOfUser')) {
        case 1: //COMPANY
            // Checking if required values for company form is filled
            $postNameArray = array(
                ["image", "Venligst legg til et bilde"],
                ["country", "Venligst velg et land"],
                ["telephone", "Venligst fyll inn telefonnummer"],
                ["specification", "Venligst velg en spesifikasjon"],
                ["numbOfEmp", "Venligst velg antall ansatte"],
                ["description", "Venligst fyll ut en beskrivelse"],
                ["postalCode", "Venligst fyll ut et postnummer"],
                ["address", "Venligst fyll ut en adresse"],
                ["orgnumber", "Venligst fyll ut et organisasjonsnummer"]
            );


            // Setting website url if filled
            if (isset($_POST['webURL']) && !empty($_POST['webURL']))
                $webURL_post = $_POST['webURL'];

            if (isset($_POST['benefits']) && !empty($_POST['benefits']))
                $benefits = $_POST['benefits'];

            // Setting variables
            $image_post = $_POST['image'];
            $country_post = $_POST['country'];
            $telephone_post = $_POST['telephone'];
            $specification_post = $_POST['specification'];
            $numOfEmp_post = $_POST['numbOfEmp'];
            $description_post = $_POST['description'];
            $postalCode_post = $_POST['postalCode'];
            $place_post = null;
            $address_post = $_POST['address'];
            $orgnumber_post = $_POST['orgnumber'];
            $requiredColumnsFilled = 1;

            // Checking if telephoneNumber is 8
            if (strlen($telephone_post) != 8) {
                $error = "Telefonnummer må være 8 siffre";
                return;
            }
            // Checking if postalCode is 4
            if (strlen($postalCode_post) != 4) {
                $error = "Postnummer må være 4 siffre";
                return;
            }
            // Checking if orgNumber is 9
            if (strlen($orgnumber_post) != 9) {
                $error = "Organisasjonsnummer må være 9 siffre";
                return;
            }

            //TODO: kanskje sjekke om addresse faktisk finnes????? (ikke prioritert)

            $conn = getDb();
            // CHECKING IG POSTAL CODE IS VALID
            $stmtCheckPostalInDB = "SELECT postalAddress FROM postal
                                    WHERE postalCode = ?";
            $stmtCheckPostalInDB = $conn->prepare($stmtCheckPostalInDB);
            $stmtCheckPostalInDB->bind_param('s', $postalCode_post);
            $stmtCheckPostalInDB->execute();
            $stmtCheckPostalInDB->bind_result($postalAddress_fromSQL);
            $stmtCheckPostalInDB->store_result();

            if ($stmtCheckPostalInDB->num_rows === 1) {
                $stmtCheckPostalInDB->fetch();
                $place_post = $postalAddress_fromSQL;
            } else {
                $error = "Postnummeret finnes ikke";
                return;
            }
            break;
        case 2: // CONSULTANT
            // Checking if required values for consultant form is filled
            $postNameArray = array(
                ["image", "Venligst legg til et bilde"],
                ["country", "Venligst velg et land"],
                ["telephone", "Venligst fyll inn telefonnummer"],
                ["specification", "Venligst velg en spesifikasjon"],
                ["age", "Venligst fyll inn en alder"],
                ["levelOfXp", "Venligst velg et erfaringsnivå"]
            );

            for ($i=0; $i < sizeof($postNameArray); $i++) {
                $error = checkPost($postNameArray[$i]);
                if (!$error) {
                    $error = $postNameArray[$i][1];
                    return;
                } else {
                    $error = null;
                    ${$postNameArray[$i][0].'_post'} = $_POST[''.$postNameArray[$i][0].''];
                }
            }

            // Setting description if filled
            if (isset($_POST['description']) && !empty($_POST['description']))
                $description_post = $_POST['description'];

            // Setting website url if filled
            if (isset($_POST['webURL']) && !empty($_POST['webURL']))
                $webURL_post = $_POST['webURL'];

            // Setting variables
            $image_post = $_POST['image'];
            $country_post = $_POST['country'];
            $telephone_post = $_POST['telephone'];
            $specification_post = $_POST['specification'];
            $age_post = $_POST['age'];
            $levelOfXp_post = $_POST['levelOfXp'];
            $requiredColumnsFilled = 1;
            break;
        case 3: // Normal user
            // Checking if required values for consultant form is filled
            $postNameArray = array(
                ["image", "Venligst legg til et bilde"],
                ["country", "Venligst velg et land"],
                ["telephone", "Venligst fyll inn telefonnummer"],
                ["numbOfEmp", "Venligst velg antall ansatte"],
                ["gender", "Venligst velg et kjønn"],
                ["industry", "Venligst velg en industri"],
                ["startupPhase", "Venligst velg en fase"],
                ["lookingFor", "Venligst om du leter etter noen"],
                ["businessModel", "Venligst velg en businessmodell"],
                ["title", "Venligst skriv inn en tittel"],
                ["specification", "Venligst velg en spesifikasjon"],
                ["age", "Venligst fyll inn en alder"]
            );

            for ($i=0; $i < sizeof($postNameArray); $i++) {
                $error = checkPost($postNameArray[$i]);
                if (!$error) {
                    $error = $postNameArray[$i][1];
                    return;
                } else {
                    $error = null;
                    ${$postNameArray[$i][0].'_post'} = $_POST[''.$postNameArray[$i][0].''];
                }
            }

            // Setting variables
            $image_post = $_POST['image'];
            $country_post = $_POST['country'];
            $telephone_post = $_POST['telephone'];
            $numOfEmp_post = $_POST['numbOfEmp'];
            $gender_post = $_POST['gender'];
            $industry_post = $_POST['gender'];
            $industry_post = $_POST['industry'];
            $startupPhase_post = $_POST['startupPhase'];
            $lookingFor_post = $_POST['lookingFor'];
            $businessModel_post = $_POST['businessModel'];
            $title_post = $_POST['title'];
            $specification_post = $_POST['specification'];
            $age_post = $_POST['age'];
            $requiredColumnsFilled = 1;
            break;
    }


    function checkPost($array) {
        $isValidPost = true;
        if ( !isset($_POST[''.$array[0].'']) || empty($_POST[''.$array[0].'']) ) {
            $isValidPost = false;
        }
        return $isValidPost;
    }


    include_once '../backend/session.php';
    $userId = $_SESSION['userdata']->__get('id_user');

    // Updating userdata in DB for user
    include_once '../backend/db.php';

    $conn = getDb();

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
                                   requiredColumnsFilled = ?,
                                   image = ?,
                                   country = ?,
                                   benefits = ?,
                                   gender = ?,
                                   industry = ?,
                                   startupPhase = ?,
                                   lookingFor = ?,
                                   businessModel = ?,
                                   title = ?,
                                   numOfEmp = ?
                               WHERE id_user = ?";
    $stmtUpdateUserdataToDB = $conn->prepare($stmtUpdateUserdataToDB);
    $stmtUpdateUserdataToDB->bind_param('ssssssssssssssssssssssss', $telephone_post, $postalCode_post, $place_post, $address_post, $orgnumber_post, $rating1to5, $ratingNumberOfVoters, $specification_post, $levelOfXp_post, $webURL_post, $description_post, $age_post, $requiredColumnsFilled, $image_post, $country_post, $benefits_post, $gender_post, $industry_post, $startupPhase_post, $lookingFor_post, $businessModel_post, $title_post, $numOfEmp_post, $userId);
    $stmtUpdateUserdataToDB->execute();
    $stmtUpdateUserdataToDB->close();

    // ADDING TO SESSION
    setRestOfSession_registerFull($telephone_post, $postalCode_post, $place_post, $address_post, $orgnumber_post, $rating1to5, $ratingNumberOfVoters, $specification_post, $levelOfXp_post, $webURL_post, $description_post, $age_post, $requiredColumnsFilled, $image_post, $country_post, $benefits_post, $gender_post, $industry_post, $startupPhase_post, $lookingFor_post, $businessModel_post, $title_post, $numOfEmp_post);

    // Going back to main
    header('LOCATION: ../index.php');


