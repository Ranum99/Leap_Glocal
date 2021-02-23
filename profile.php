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

    if ($profileId != md5($_SESSION['userdata']->__get('id_user'))) {
        $user = new User();

        $connen = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

        $stmtCheckIfUserExist = "SELECT id_user FROM users
                                 WHERE md5(id_user) = ?";
        $stmtCheckIfUserExist = $connen->prepare($stmtCheckIfUserExist);
        $stmtCheckIfUserExist->bind_param('s', $profileId);
        $stmtCheckIfUserExist->execute();
        $stmtCheckIfUserExist->bind_result($id_userFromSQL);
        $stmtCheckIfUserExist->store_result();

        if ($stmtCheckIfUserExist->num_rows === 1) {
            $stmtCheckIfUserExist->fetch();
            getDataForUser($connen, $id_userFromSQL, $user);
        } else
            goback();
    } else
        $user = $_SESSION['userdata'];

    function getDataForUser($connen, $id_user, $user) {
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
        <?php if ($user == $_SESSION['userdata']) echo '<a class="asButton" href="backend/logout.php">Logg ut</a>' ?>
        <?php echo $fillInRestOfDataBtn; ?>
        <p>Email: <?php echo  $user->__get('email')?></p>
    </main>


    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/footer.php" ?>
</body>
</html>