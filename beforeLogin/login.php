<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../global/common.css">
    <link rel="stylesheet" type="text/css" href="css/registerAndLogin.css">
</head>
<body>
<!-- HERE COMES <NAV/> FROM PHP FILE -->
<?php include_once "../partsOfWebsite/nav.php"?>

<main>
    <!-- LOGIN -->
    <h1>Logg inn</h1>
    <section class="registerAndLoginForm">
        <form action="" method="post">
            <label for="emailLogin">Epost</label>
            <input type="email" id="emailLogin" name="email" placeholder="Epost" required>
            <label for="passwordLogin">Passord</label>
            <input type="password" id="passwordLogin" name="password" placeholder="Passord" required>

            <button>Logg inn</button>
        </form>
        <div class="toLoginOrRegister">
            <h2>Enda ikke medlem?</h2>
            <p>For å starte reisen med oss, venligst registrer deg ved å trykke på knappen under.</p>
            <a class="asButton" href="register.php">Registrer</a>
        </div>
    </section>
</main>

<!-- HERE COMES <FOOTER/> FROM PHP FILE -->
<?php include_once "../partsOfWebsite/footer.php"?>
</body>
</html>