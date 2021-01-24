<?php
    include_once '../backend/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../global/common.css">
    <link rel="stylesheet" type="text/css" href="css/registerAndLogin.css">
    <script src="js/typeOfUser.js"></script>
</head>
<body>
<!-- HERE COMES <NAV/> FROM PHP FILE -->
<?php include_once "../partsOfWebsite/nav.php"?>

<main>
    <!-- LOGIN -->
    <h1>Logg inn</h1>
    <section class="registerAndLoginForm">
        <form action="backend/loginBack.php" method="post">
            <div class="typeOfUser">
                <label class="typeOfUser_label" for="typeOfUser_company">Bedrift</label>
                <input class="typeOfUser_input" type="radio" id="typeOfUser_company" name="typeOfUser" value="1" checked required />
                <label class="typeOfUser_label" for="typeOfUser_consultant">Konsulent</label>
                <input class="typeOfUser_input" type="radio" id="typeOfUser_consultant" name="typeOfUser" value="2" />
                <label class="typeOfUser_label" for="typeOfUser_user">Bruker</label>
                <input class="typeOfUser_input" type="radio" id="typeOfUser_user" name="typeOfUser" value="3" />
            </div>

            <label for="emailLogin">Epost</label>
            <input type="email" id="emailLogin" name="email" placeholder="Epost" required />
            <label for="passwordLogin">Passord</label>
            <input type="password" id="passwordLogin" name="password" placeholder="Passord" required />

            <button>Logg inn</button>
        </form>
        <div class="toLoginOrRegister">
            <h2>Enda ikke medlem?</h2>
            <p>For å starte reisen med oss, venligst registrer deg ved å trykke på knappen under.</p>
            <a class="asButton" href="register.php">Bli medlem</a>
        </div>
    </section>
</main>

<!-- HERE COMES <FOOTER/> FROM PHP FILE -->
<?php include_once "../partsOfWebsite/footer.php"?>
</body>
</html>