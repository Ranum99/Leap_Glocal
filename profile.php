<?php
    include_once 'backend/session.php';

    $fillInRestOfDataBtn = "";
    if (getDataFromSessionColumn("hasFilledAllColumns") == false)
        $fillInRestOfDataBtn = '<a class="asButton" href="loginRegister/registerUser.php">Fyll inn manglende data</a>';
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

    <a class="asButton" href="backend/logout.php">Logg ut</a>
    <?php echo $fillInRestOfDataBtn; ?>


    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/footer.php"?>
</body>
</html>