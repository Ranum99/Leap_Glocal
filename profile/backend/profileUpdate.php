<?php
    $error = "";

    $telephone_post = null;
    $specification_post = null;
    $description_post = null;
    $webURL_post = null;
    $twitter_post =  null;
    $instagram_post = null;
    $facebook_post = null;
    $name_post = null;
    $email_post = null;
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

    switch ($_SESSION['userdata']->__get('typeOfUser')) {
        case 1: //COMPANY
            // Setting website url if filled
            if (isset($_POST['webURL']) && !empty($_POST['webURL']))
                $webURL_post = $_POST['webURL'];

            if (isset($_POST['benefits']) && !empty($_POST['benefits']))
                $benefits = $_POST['benefits'];

            // Setting variables
            $typeUser_post = $_POST["typeOfUser"];
            $typeUser = $typeUser_post;
            $image_post = $_POST['image'];
            $country_post = $_POST['country'];
            $telephone_post = $_POST['telephone'];
            $twitter_post = $_POST['twitter'];
            $instagram_post = $_POST['instagram'];
            $facebook_post = $_POST['facebook'];
            $name_post = $_POST['name'];
            $email_post = $_POST['email'];
            $specification_post = $_POST['specification'];
                $specification_post = explode(' ', $specification_post);
                $specification_post = array_unique($specification_post);
                $specification_post = implode('.', $specification_post);
            $numOfEmp_post = $_POST['numbOfEmp'];
            $description_post = $_POST['description'];
            $postalCode_post = $_POST['postalCode'];
            $place_post = null;
            $address_post = $_POST['address'];
            $orgnumber_post = $_POST['orgnumber'];
            $requiredColumnsFilled = 1;
            $password_post = $_POST["password"];
            $password = $password_post;
            $confirm_password_post = $_POST["confirm_password"];
            $hashPassword = password_hash($password_post, PASSWORD_DEFAULT);

            if ($password_post != $confirm_password_post) {
                $error = "Passordene må være like";
                return;
            }

            if(filter_var($email_post, FILTER_VALIDATE_EMAIL)) {
                // Return success - Valid Email
                $msg = 'Din bruker har blitt opprettet, <br /> venligst bekreft brukeren ved å trykke på aktivasjonslenken som har blitt sendt til din email.';
            } else {
                // Return Error - Invalid Emaiil
                $error = "Ugyldig epost";
                return;
            }

            $userAlreadyExists = checkIfUsersAlreadyExists($email_post, $typeUser_post);
            if ($userAlreadyExists) {
                $error = "Det er allerede registrert en bruker med samme epost og brukertype";
                return;
            }

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

            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);

            if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                $error = "Ugyldig passord";
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
            $specification_post = explode(' ', $specification_post);
            $specification_post = array_unique($specification_post);
            $specification_post = implode('.', $specification_post);
            $age_post = $_POST['age'];
            $levelOfXp_post = $_POST['levelOfXp'];
            $requiredColumnsFilled = 1;
            $twitter_post = $_POST['twitter'];
            $instagram_post = $_POST['instagram'];
            $facebook_post = $_POST['facebook'];
            $name_post = $_POST['name'];
            $email_post = $_POST['email'];
            $typeUser_post = $_POST["typeOfUser"];
            $typeUser = $typeUser_post;
            $password_post = $_POST["password"];
            $password = $password_post;
            $confirm_password_post = $_POST["confirm_password"];
            $hashPassword = password_hash($password_post, PASSWORD_DEFAULT);

            if ($password_post != $confirm_password_post) {
                $error = "Passordene må være like";
                return;
            }

            if(filter_var($email_post, FILTER_VALIDATE_EMAIL)) {
                // Return success - Valid Email
                $msg = 'Din bruker har blitt opprettet, <br /> venligst bekreft brukeren ved å trykke på aktivasjonslenken som har blitt sendt til din email.';
            } else {
                // Return Error - Invalid Emaiil
                $error = "Ugyldig epost";
                return;
            }

            $userAlreadyExists = checkIfUsersAlreadyExists($email_post, $typeUser_post);
            if ($userAlreadyExists) {
                $error = "Det er allerede registrert en bruker med samme epost og brukertype";
                return;
            }

            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);

            if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                $error = "Ugyldig passord";
                return;
            }
            break;
        case 3: // Normal user
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
            $specification_post = explode(' ', $specification_post);
            $specification_post = array_unique($specification_post);
            $specification_post = implode('.', $specification_post);
            $age_post = $_POST['age'];
            $requiredColumnsFilled = 1;
            $twitter_post = $_POST['twitter'];
            $instagram_post = $_POST['instagram'];
            $facebook_post = $_POST['facebook'];
            $name_post = $_POST['name'];
            $email_post = $_POST['email'];
            $typeUser_post = $_POST["typeOfUser"];
            $typeUser = $typeUser_post;
            $password_post = $_POST["password"];
            $password = $password_post;
            $confirm_password_post = $_POST["confirm_password"];
            $hashPassword = password_hash($password_post, PASSWORD_DEFAULT);

            if ($password_post != $confirm_password_post) {
                $error = "Passordene må være like";
                return;
            }

            if(filter_var($email_post, FILTER_VALIDATE_EMAIL)) {
                // Return success - Valid Email
                $msg = 'Din bruker har blitt opprettet, <br /> venligst bekreft brukeren ved å trykke på aktivasjonslenken som har blitt sendt til din email.';
            } else {
                // Return Error - Invalid Emaiil
                $error = "Ugyldig epost";
                return;
            }

            $userAlreadyExists = checkIfUsersAlreadyExists($email_post, $typeUser_post);
            if ($userAlreadyExists) {
                $error = "Det er allerede registrert en bruker med samme epost og brukertype";
                return;
            }

            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);

            if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                $error = "Ugyldig passord";
                return;
            }

            break;
    }

    function checkPost($array) {
        $isValidPost = true;
        if ( !isset($_POST[''.$array[0].'']) || empty($_POST[''.$array[0].'']) ) {
            $isValidPost = false;
        }
        return $isValidPost;
    }

    include_once '../../backend/session.php';
    $userId = $_SESSION['userdata']->__get('id_user');

    // Updating userdata in DB for user
    include_once '../../backend/db.php';

    $conn = getDb();

    $stmtUpdateUserdataToDB = "UPDATE users SET
                                   email = ?,
                                   password = ?,
                                   name = ?,
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
                                   country = ?,
                                   benefits = ?,
                                   gender = ?,
                                   industry = ?,
                                   startupPhase = ?,
                                   lookingFor = ?,
                                   businessModel = ?,
                                   title = ?,
                                   numOfEmp = ?,  
                                   twitterHandle = ?,
                                   instagramHandle = ?,
                                   facebookHandle = ?
                               WHERE id_user = ?";
    $stmtUpdateUserdataToDB = $conn->prepare($stmtUpdateUserdataToDB);
    $stmtUpdateUserdataToDB->bind_param('sssissssisssssisssssssssssssi', $email_post, $password_post, $name_post, $telephone_post, $postalCode_post, $place_post,
                                        $address_post, $orgnumber_post, $rating1to5, $ratingNumberOfVoters, $specification_post, $levelOfXp_post, $webURL_post, $description_post,
                                        $age_post, $requiredColumnsFilled, $country_post, $benefits_post, $gender_post, $industry_post, $startupPhase_post, $lookingFor_post,
                                        $businessModel_post, $title_post, $numOfEmp_post, $twitter_post, $instagram_post, $facebook_post, $userId);
    $stmtUpdateUserdataToDB->execute();
    $stmtUpdateUserdataToDB->close();

    // ADDING TO SESSION
    setRestOfSession_updateFull($email_post, $password_post, $name_post, $telephone_post, $postalCode_post, $place_post, $address_post, $orgnumber_post, $rating1to5, $ratingNumberOfVoters, $specification_post,
                                $levelOfXp_post, $webURL_post, $description_post, $age_post, $requiredColumnsFilled, $country_post, $benefits_post, $gender_post, $industry_post, $startupPhase_post,
                                $lookingFor_post, $businessModel_post, $title_post, $numOfEmp_post, $twitter_post, $instagram_post, $facebook_post);
    // Going back to main
    header('LOCATION: ../../profile.php');


