<?php
    include_once 'backend/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="global/common.css">
</head>
<body>
    <!-- HERE COMES <NAV/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/nav.php"?>

    <label for="search">Søk</label>
    <input type="text" autofocus id="search">


    <?php
        if (sizeof($_SESSION) > 0) {
            echo '<br><br><br>BRUKERINFO:<br><br>';
            echo 'ID: ' . $_SESSION['idUser'] . '<br>';
            echo 'EPOST: ' . $_SESSION['email'] . '<br>';
            echo 'NAVN: ' . $_SESSION['name'] . '<br>';
            echo 'PASSORD: ' . $_SESSION['password'] . '<br>';
            echo 'TYPE BRUKER: ' . $_SESSION['typeOfUser'] . '<br>';


            echo 'TELEFON: ' . $_SESSION['phoneNumber'] . '<br>';
            echo 'POSTNUMMER: ' . $_SESSION['postalCode'] . '<br>';
            echo 'STED: ' . $_SESSION['place'] . '<br>';
            echo 'ADRESSE: ' . $_SESSION['address'] . '<br>';
            echo 'ORGNUMMER: ' . $_SESSION['orgNumber'] . '<br>';
            echo 'RATING (1-5): ' . $_SESSION['rating1to5'] . '<br>';
            echo 'RATING ANTALL STEMMER: ' . $_SESSION['ratingNumberOfVoters'] . '<br>';
            echo 'SPESIFIKASJON: ' . $_SESSION['specification'] . '<br>';
            echo 'ERFARINGSNIVÅ: ' . $_SESSION['levelOfXp'] . '<br>';
            echo 'NETTSIDE: ' . $_SESSION['webURL'] . '<br>';
            echo 'BESKRIVELSE: ' . $_SESSION['description'] . '<br>';
            echo 'BRUKER HAR BETALT?: ' . $_SESSION['userHasPaid'] . '<br>';
            echo 'BRUKER SISTE BETALING: ' . $_SESSION['userLastPayment'] . '<br>';
            echo 'SISTE BETALING VARIGHET: ' . $_SESSION['lastPaymentDuration'] . '<br>';
            echo 'ALDER: ' . $_SESSION['age'] . '<br>';

            echo 'BRUKER HAR FYLT ALLE FELTER?: ' . $_SESSION['hasFilledAllColumns'] . '<br>';
        }
    ?>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/footer.php"?>
</body>
</html>