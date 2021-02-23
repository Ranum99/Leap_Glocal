<?php
    include_once 'backend/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hovedside</title>
    <link rel="stylesheet" type="text/css" href="global/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <!-- Including jQuery is required. -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Including our scripting file. -->
    <script type="text/javascript" src="search/scripts.js"></script>
    <!-- Including CSS file. -->
    <link rel="stylesheet" type="text/css" href="search/style.css">
</head>
<body>
    <div class="banner-bilde">
        <!-- HERE COMES <NAV/> FROM PHP FILE -->
        <?php include_once "partsOfWebsite/nav.php" ?>
        <div class="banner-tekst">
            <h1>Dette er en test</h1>
            <p>Dette er en test</p>
            <button>Test knapp</button>
        </div>
    </div>
    <?php echo _EMAIL?>


    <main>
        <section>
            <h2 id="sporsmalOverskrift">Her finner du svar på alle dine spørsmål</h2>
            <article id="searchBox">
                <div>
                    <!-- Search box. -->
                    <input type="text" id="search" placeholder="Hva lurer du på?" autocomplete="off" />

                    <button id="mainSearchButton">Søk</button>
                    <br />
                    <!-- Suggestions will be displayed in below div. -->
                    <div id="display"></div>
                </div>
            </article>
            <!-- Kalender -->
        </section>

        <section>
            <div id="functions">
                <a href="">
                    <h3>Finn andre gründere</h3>
                    <p>Her kan du søke på andre gründere nært of fjernt med samme ideer for å muligens få noe hjelp.</p>
                </a>
                <a href="">
                    <h3>Gründerhuber og akseleratorer</h3>
                    <p>Meld deg på forskjellige gründerhubber og akseleratorer nært og fjernt for å finne gode ideer til din startup.</p>
                </a>
                <a href="">
                    <h3>Støtteordninger</h3>
                    <p>Nettop start opp eller langt ut i prosessen, men ikke er helt sikker på hvilken rettigheter på støtte du har?</p>
                </a>
                <a href="contactConsultant/user/">
                    <h3>Kontakt en konsulent</h3>
                    <p>Har du et spørsmål du ikke finner svaret på, eller noe som trenger spesialkompetanse, kotakt en kompetent konsulent her.</p>
                </a>
            </div>
        </section>
    </main>

    <?php
        /*
        if (isset($_SESSION['userdata']) && sizeof($_SESSION) > 0) {
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


            echo 'BILDE: ' . $_SESSION['userdata']->__get('image') . '<br>';
            echo 'LAND: ' . $_SESSION['userdata']->__get('country') . '<br>';
            echo 'FORDELER: ' . $_SESSION['userdata']->__get('benefits') . '<br>';
            echo 'ANTALL ANSATTE: ' . $_SESSION['userdata']->__get('numOfEmp') . '<br>';
            echo 'KJØNN: ' . $_SESSION['userdata']->__get('gender') . '<br>';
            echo 'INDUSTRI: ' . $_SESSION['userdata']->__get('industry') . '<br>';
            echo 'STARTUP FASE: ' . $_SESSION['userdata']->__get('startupPhase') . '<br>';
            echo 'SER ETTER: ' . $_SESSION['userdata']->__get('lookingFor') . '<br>';
            echo 'BUSINESSMODELL: ' . $_SESSION['userdata']->__get('businessModel') . '<br>';
            echo 'TITTEL: ' . $_SESSION['userdata']->__get('title') . '<br>';
            
        }
        */
    ?>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/footer.php" ?>
</body>
</html>