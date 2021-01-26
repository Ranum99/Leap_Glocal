<?php
    include_once '../backend/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../global/common.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/registerAndLogin.css">
    <script src="js/typeOfUser.js"></script>
</head>
<body>
    <!-- HERE COMES <NAV/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/nav.php"?>

    <main>
        <!-- REGISTER -->
        <h1>Registrer bruker</h1>
        <section class="registerAndLoginForm">
            <div class="toLoginOrRegister">
                <h2>Allerede medlem?</h2>
                <p>For å fortsette reisen med oss, venligst logg inn ved å trykke på knappen under.</p>
                <a class="asButton" href="login.php">Logg inn</a>
            </div>
            <form action="backend/registerBack.php" method="post">
                <div class="typeOfUser">
                    <label class="typeOfUser_label" for="typeOfUser_company">Bedrift</label>
                    <input class="typeOfUser_input" type="radio" id="typeOfUser_company" name="typeOfUser" value="1" checked required />
                    <label class="typeOfUser_label" for="typeOfUser_consultant">Konsulent</label>
                    <input class="typeOfUser_input" type="radio" id="typeOfUser_consultant" name="typeOfUser" value="2" />
                    <label class="typeOfUser_label" for="typeOfUser_user">Bruker</label>
                    <input class="typeOfUser_input" type="radio" id="typeOfUser_user" name="typeOfUser" value="3" />
                </div>

                <label for="emailRegister">Epost</label>
                <input type="email" id="emailRegister" name="email" placeholder="Epost" required autofocus pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" />
                <label for="nameRegister">Navn</label>
                <input type="text" id="nameRegister" name="name" placeholder="Navn" required />
                <label for="passwordRegister">Passord</label>
                <input type="password" id="passwordRegister" name="password" placeholder="Passord" required title="Passord må inneholde minst en stor bokstav, en liten bokstav, ett tall, ett spesialtegn og være minst 8 tegn lang" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" />
                <label for="repeatPasswordRegister">Gjenta passord</label>
                <input type="password" id="repeatPasswordRegister" name="repeatPassword" placeholder="Gjenta passord" required title="Passord må inneholde minst en stor bokstav, en liten bokstav, ett tall, ett spesialtegn og være minst 8 tegn lang" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" />

                <button>Registrer</button>
            </form>
        </section>
    </main>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/footer.php"?>
</body>
</html>