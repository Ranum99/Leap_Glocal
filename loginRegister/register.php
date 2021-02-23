<?php
    include_once '../backend/session.php';
    include_once '\xampp\htdocs\skole\leap-glocal\loginRegister\backend\registerBack.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../global/common.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/registerAndLogin.css">
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
            <form action="" method="post">
                <div class="typeOfUser">
                    <input class="typeOfUser_input" type="radio" id="typeOfUser_company" name="typeOfUser" value="1" <?php if ($typeUser == 1 || $typeUser == "") echo 'checked' ?> required />
                    <label class="typeOfUser_label" for="typeOfUser_company">Bedrift</label>
                    <input class="typeOfUser_input" type="radio" id="typeOfUser_consultant" name="typeOfUser" value="2" <?php if ($typeUser == 2) echo 'checked' ?> />
                    <label class="typeOfUser_label" for="typeOfUser_consultant">Konsulent</label>
                    <input class="typeOfUser_input" type="radio" id="typeOfUser_user" name="typeOfUser" value="3" <?php if ($typeUser == 3) echo 'checked' ?> />
                    <label class="typeOfUser_label" for="typeOfUser_user">Bruker</label>
                </div>

                <label for="emailRegister">Epost</label>
                <input value="<?php echo $email; ?>" type="email" id="emailRegister" name="email" placeholder="Epost" required autofocus pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" />
                <label for="nameRegister">Navn</label>
                <input value="<?php echo $name; ?>" type="text" id="nameRegister" name="name" placeholder="Navn" required />
                <label for="passwordRegister">Passord</label>
                <input type="password" id="passwordRegister" name="password" placeholder="Passord" required title="Passord må inneholde minst en stor bokstav, en liten bokstav, ett tall, ett spesialtegn og være minst 8 tegn lang" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" />
                <label for="repeatPasswordRegister">Gjenta passord</label>
                <input type="password" id="repeatPasswordRegister" name="repeatPassword" placeholder="Gjenta passord" required title="Passord må inneholde minst en stor bokstav, en liten bokstav, ett tall, ett spesialtegn og være minst 8 tegn lang" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" />

                <p id="errorMessage"><?php echo $error; ?></p>

                <button>Registrer</button>
            </form>
        </section>
    </main>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/footer.php"?>
</body>
</html>