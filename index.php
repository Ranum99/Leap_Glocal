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
    <link rel="stylesheet" type="text/css" href="search/style.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="search/scripts.js"></script>
    <script src="https://kit.fontawesome.com/397d207bea.js" crossorigin="anonymous"></script>
</head>
<body>
<!-- HERE COMES <NAV/> FROM PHP FILE -->
<?php include_once "partsOfWebsite/nav.php" ?>

    <div id="banner-bilde-forside">

        <div class="banner-tekst">
            <h1 id="sporsmalOverskrift">Her finner du svar på alle dine spørsmål</h1>

            <article>
                <div class="searchBox">
                    <!-- Search box. -->
                    <input type="search" id="search" placeholder="Hva lurer du på?" autocomplete="off" />
                    <button id="mainSearchButton">Søk</button>
                    <br />
                    <!-- Suggestions will be displayed in below div. -->
                    <div id="display"></div>
                </div>
            </article>
        </div>
    </div>

    <main>
        <section>
            <div class="flex-container">
                <div class="flex-child">
                    <br><br>
                    <h3>Finn andre gründere</h3>
                    <p>Her kan du søke på andre gründere nært og fjernt med samme ideer for å muligens få noe hjelp.</p>
                    <a href="/"><button class="bn632-hover bn26">Les mer</button></a>
                </div>
                <div class="fill">
                    <img src="img/gründere.jpg" alt="Bilde av gründere">
                </div>
            </div>
        </section>
        <section>
            <div class="flex-container">
                <div class="fill">
                    <img src="img/akselerator.jpg" alt="Bilde av akselerator">
                </div>
                <div class="flex-child">
                    <br><br>
                    <h3>Gründerhuber og akseleratorer</h3>
                    <p>Meld deg på forskjellige gründerhubber og akseleratorer nært og fjernt for å finne gode ideer til din startup.</p>
                    <a href="partsOfWebsite/calender.php"><button class="bn632-hover bn26">Les mer</button></a>
                </div>
            </div>
        </section>
        <section>
            <div class="flex-container">
                <div class="flex-child">
                    <br><br>
                    <h3>Støtteordninger</h3>
                    <p>Nettopp startet opp eller langt ut i prosessen, men ikke er helt sikker på hvilken rettigheter på støtte du har?</p>
                    <a href="/"><button class="bn632-hover bn26">Les mer</button></a>
                </div>
                <div class="fill">
                    <img src="img/penger.jpg" alt="Bilde av penger">
                </div>
            </div>
        </section>
        <section>
            <div class="flex-container">
                <div class="fill">
                    <img src="img/konsulent.jpg" alt="Bilde av penger">
                </div>
                <div class="flex-child">
                    <br><br>
                    <h3>Kontakt en konsulent</h3>
                    <p>Har du et spørsmål du ikke finner svaret på, eller noe som trenger spesialkompetanse, kontakt en kompetent konsulent her.</p>
                    <a href="/"><button class="bn632-hover bn26">Les mer</button></a>
                </div>
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