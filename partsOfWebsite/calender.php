<?php
    include_once '../backend/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calender</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
    <div id="banner-bilde-kalender">
        <!-- HERE COMES <NAV/> FROM PHP FILE -->
        <?php include_once "../partsOfWebsite/nav.php" ?>

        <div class="banner-tekst">
            <h1>Test</h1>
        </div>
    </div>

    <main>
        <section>
            <!-- partial:index.partial.html -->
            <div id="calendar"></div>
            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
            <!-- partial -->
            <script  src="js/script.js"></script>
        </section>
    </main>
</body>