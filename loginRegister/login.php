<?php
    include_once '../backend/session.php';
    include_once '\xampp\htdocs\skole\leap-glocal\loginRegister\backend\loginBack.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../global/common.css">
    <link rel="stylesheet" type="text/css" href="css/registerAndLogin.css">
    <link rel="stylesheet" type="text/css" href="../partsOfWebsite/css/footer.css">
    <script src="https://kit.fontawesome.com/84fdcc201f.js" crossorigin="anonymous"></script>
</head>
<body>
<!-- HERE COMES <NAV/> FROM PHP FILE -->
<?php include_once "../partsOfWebsite/nav.php"?>

<main>
    <div class="spacer"></div>

    <!-- LOGIN -->
    <section class="registerAndLoginForm">
        <form action="" method="post">
            <h1 class="marginTop">Logg inn</h1>

            <div class="typeOfUser">
                <input class="typeOfUser_input" type="radio" id="typeOfUser_company" name="typeOfUser" value="1" <?php if ($typeUser == 1 || $typeUser == "") echo 'checked' ?> required />
                <label class="typeOfUser_label" for="typeOfUser_company">Bedrift</label>
                <input class="typeOfUser_input" type="radio" id="typeOfUser_consultant" name="typeOfUser" value="2" <?php if ($typeUser == 2) echo 'checked' ?> />
                <label class="typeOfUser_label" for="typeOfUser_consultant">Konsulent</label>
                <input class="typeOfUser_input" type="radio" id="typeOfUser_user" name="typeOfUser" value="3" <?php if ($typeUser == 3) echo 'checked' ?> />
                <label class="typeOfUser_label" for="typeOfUser_user">Bruker</label>
            </div>

            <p id="errorMessage"><?php echo $error; ?></p>

            <div class="inputs">
                <label for="emailLogin" class="hide">Email</label>
                <input value="<?php echo $email; ?>" type="email" id="emailLogin" name="email" placeholder="Epost" required autofocus />

                <label for="passwordLogin" class="hide">Passord</label>
                <input type="password" id="passwordLogin" name="password" placeholder="Passord" required />
            </div>

            <a href="#" class="forgot-password">Glemt passord?</a>

            <div class="loginRegisterBtnWrapper">
                <button>Logg inn</button>
            </div>

        </form>
        <div class="toRegister">
            <h2>Enda ikke medlem?</h2>
            <p>For å starte reisen med oss, venligst registrer deg ved å trykke på knappen under.</p>
            <a href="register.php" class="regOrLoginBtn">Bli medlem</a>
        </div>
    </section>
</main>

<!-- HERE COMES <FOOTER/> FROM PHP FILE -->
<?php include_once "../partsOfWebsite/footer.php"?>
</body>
</html>