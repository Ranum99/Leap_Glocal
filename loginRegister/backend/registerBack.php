<?php
    $error = "";
    $email = "";
    $name = "";
    $typeUser = "";

    if (sizeof($_POST) == 0) {
        return;
    }

    if ( !isset($_POST['email']) || empty($_POST['email']) ) {
        $error = "Venligst fyll inn epost";
        return;
    }

    if ( !isset($_POST['name']) || empty($_POST['name']) ) {
        $email = $_POST['email'];
        $error = "Venligst fyll inn navn";
        return;
    }

    if ( !isset($_POST['password']) || empty($_POST['password']) ) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $error = "Venligst fyll inn passord";
        return;
    }

    if ( !isset($_POST['repeatPassword']) || empty($_POST['repeatPassword']) ) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $error = "Venligst fyll inn gjenta passord";
        return;
    }

    if ( !isset($_POST['typeOfUser']) || empty($_POST['typeOfUser']) ) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $error = "Venligst velg en brukertype";
        return;
    }

    // Saving post as variables
    $email_post = $_POST["email"];
    $email = $email_post;
    $password_post = $_POST["password"];
    $password = $password_post;

    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $success = "Gyldig epost";
    } else{
        $error = "Ugyldig epost";
        return;
    }

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        $error = "Ugyldig passord";
        return;
    }

    /*TODO: Sjekke mail og passord med regex
        også sjekke med js før innsendelse*/

    // Saving post as variables
    $typeUser_post = $_POST["typeOfUser"];
    $typeUser = $typeUser_post;
    $name_post = $_POST["name"];
    $name = $name_post;
    $repeatPassword_post = $_POST["repeatPassword"];
    $hashPassword = password_hash($password_post, PASSWORD_DEFAULT);

    if ($password_post != $repeatPassword_post) {
        $error = "Passordene må være like";
        return;
    }

    $userAlreadyExists = checkIfUsersAlreadyExists($email_post, $typeUser_post);
    if ($userAlreadyExists) {
        $error = "Det er allerede registrert en bruker med samme epost og brukertype";
        return;
    }

    insertUserInDb($email_post, $hashPassword, $name_post, $typeUser_post);

    function checkIfUsersAlreadyExists($email, $typeUser) {
        include_once '\xampp\htdocs\skole\leap-glocal\backend\db.php';
        $userAlreadyExists = true;

        $conn = getDb();

        // Checking if email and user type is already in the DB
        $stmtCheckIfUserExist = "SELECT id_user FROM users 
                                 WHERE email = ? AND typeOfUser = ?";
        $stmtCheckIfUserExist = $conn->prepare($stmtCheckIfUserExist);
        $stmtCheckIfUserExist->bind_param('ss', $email, $typeUser);
        $stmtCheckIfUserExist->execute();
        $stmtCheckIfUserExist->bind_result($idUser_fromSQL);
        $stmtCheckIfUserExist->store_result();

        if ($stmtCheckIfUserExist->num_rows === 0)
            return false;

        return $userAlreadyExists;
    }

    function insertUserInDb($email, $password, $name, $typeUser) {
        include_once '\xampp\htdocs\skole\leap-glocal\backend\db.php';

        $conn = getDb();

        // Inserting userdata into DB
        $stmtInsertUserdataToDB = "INSERT INTO users (email, password, name, typeOfUser)
                                   VALUES (?, ?, ?, ?)";
        $stmtInsertUserdataToDB = $conn->prepare($stmtInsertUserdataToDB);
        $stmtInsertUserdataToDB->bind_param('ssss', $email, $password, $name, $typeUser);
        $stmtInsertUserdataToDB->execute();
        $stmtInsertUserdataToDB->close();

        // Setting session
        include_once '\xampp\htdocs\skole\leap-glocal\backend\session.php';
        setSession_register($email, $name, $password, $typeUser);

        //TODO: go to new site where user can pay
            //TODO: meanwhile go to new site where user can fill out rest of info

        // Going to register rest of userdata
        header('LOCATION: registerUser.php');
    }




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
