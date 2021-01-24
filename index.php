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
            echo 'ID: ' . $_SESSION['idUser'] . '<br>';
            echo 'EMAIL: ' . $_SESSION['email'] . '<br>';
            echo 'NAME: ' . $_SESSION['name'] . '<br>';
            echo 'PASSWORD: ' . $_SESSION['password'] . '<br>';
            echo 'TYPE OF USER: ' . $_SESSION['typeOfUser'] . '<br>';
            echo 'HAS FILLED ALL COLUMNS: ' . $_SESSION['hasFilledAllColumns'] . '<br>';
        }
    ?>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/footer.php"?>
</body>
</html>