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
            // USER CLASS
            echo '<br><br><br>BRUKERINFO:<br><br>';
            echo 'ID: ' . $_SESSION['userdata']->__get('id_user') . '<br>';
            echo 'EPOST: ' . $_SESSION['userdata']->__get('email') . '<br>';
            echo 'NAVN: ' . $_SESSION['userdata']->__get('name') . '<br>';
            echo 'PASSORD: ' . $_SESSION['userdata']->__get('password') . '<br>';
            echo 'TYPE BRUKER: ' . $_SESSION['userdata']->__get('typeOfUser') . '<br>';


            echo 'TELEFON: ' . $_SESSION['userdata']->__get('phoneNumber') . '<br>';
            echo 'POSTNUMMER: ' . $_SESSION['userdata']->__get('postalCode') . '<br>';
            echo 'STED: ' . $_SESSION['userdata']->__get('place') . '<br>';
            echo 'ADRESSE: ' . $_SESSION['userdata']->__get('address') . '<br>';
            echo 'ORGNUMMER: ' . $_SESSION['userdata']->__get('orgNumber') . '<br>';
            echo 'RATING (1-5): ' . $_SESSION['userdata']->__get('rating1to5') . '<br>';
            echo 'RATING ANTALL STEMMER: ' . $_SESSION['userdata']->__get('ratingNumberOfVoters') . '<br>';
            echo 'SPESIFIKASJON: ' . $_SESSION['userdata']->__get('specification') . '<br>';
            echo 'ERFARINGSNIVÅ: ' . $_SESSION['userdata']->__get('levelOfXp') . '<br>';
            echo 'NETTSIDE: ' . $_SESSION['userdata']->__get('webURL') . '<br>';
            echo 'BESKRIVELSE: ' . $_SESSION['userdata']->__get('description') . '<br>';
            echo 'BRUKER HAR BETALT?: ' . $_SESSION['userdata']->__get('userHasPaid') . '<br>';
            echo 'BRUKER SISTE BETALING: ' . $_SESSION['userdata']->__get('userLastPayment') . '<br>';
            echo 'SISTE BETALING VARIGHET: ' . $_SESSION['userdata']->__get('lastPaymentDuration') . '<br>';
            echo 'ALDER: ' . $_SESSION['userdata']->__get('age') . '<br>';

            echo 'BRUKER HAR FYLT ALLE FELTER?: ' . $_SESSION['userdata']->__get('requiredColumnsFilled') . '<br>';
            
        }
    ?>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/footer.php"?>
</body>
</html>