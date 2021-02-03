<?php
    include_once 'backend/session.php';
    include_once 'backend/db.php';
    include_once 'global/global.php';
    include_once 'User.php';

    $fillInRestOfDataBtn = "";
    if (getDataFromSessionColumn_userdata("requiredColumnsFilled") == 0)
        $fillInRestOfDataBtn = '<a class="asButton" href="loginRegister/registerUser.php">Fyll inn manglende data</a>';

    if (!isset($_GET['user']) && !empty($_GET['user']))
        goback();

    $profileId = $_GET['user'];

    $user = new User();

    $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

    $stmtCheckIfUserExist = "SELECT id_user FROM users";
    $stmtCheckIfUserExist = $connen->prepare($stmtCheckIfUserExist);
    $stmtCheckIfUserExist->execute();
    $stmtCheckIfUserExist->bind_result($id_userFromSQL);
    $stmtCheckIfUserExist->store_result();

    if ($stmtCheckIfUserExist->num_rows > 0) {
        $userExists = false;
        while ($stmtCheckIfUserExist->fetch()) {
            if (password_verify($id_userFromSQL, $profileId)) {
                getDataForUser($connen, $id_userFromSQL, $user);
                $userExists = true;
                break;
            }
        }
        if (!$userExists)
            goback();
    }

    function getDataForUser ($connen, $id_user, $user) {
        $stmtGetUserdata = "SELECT email FROM users
                                 WHERE id_user = ?";
        $stmtGetUserdata = $connen->prepare($stmtGetUserdata);
        $stmtGetUserdata->bind_param('s', $id_user);
        $stmtGetUserdata->execute();
        $stmtGetUserdata->bind_result($emailFromSQL);
        $stmtGetUserdata->store_result();
        $stmtGetUserdata->fetch();

        $user->__set('email', $emailFromSQL);
    }

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
    <?php include_once "partsOfWebsite/nav.php" ?>

    <main>
        <a class="asButton" href="backend/logout.php">Logg ut</a>
        <?php echo $fillInRestOfDataBtn; ?>
        <p>Email: <?php echo  $user->__get('email')?></p>
    </main>


    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/footer.php" ?>
</body>
</html>