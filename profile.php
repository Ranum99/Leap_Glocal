<?php
    include_once 'backend/session.php';
    include_once 'backend/db.php';
    include_once 'global/global.php';
    include_once 'User.php';

    $fillInRestOfDataBtn = "";
    if (getDataFromSessionColumn_userdata("requiredColumnsFilled") == 0)
        $fillInRestOfDataBtn = '<a href="loginRegister/registerUser.php" class="messageBtn">Fill in more data</a>';

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
        $emailFromSQL = null;
        $nameFromSQL = null;
        $phoneNumberFromSQL = null;
        $addressFromSQL = null;
        $descriptionFromSQL = null;
        $countryFromSQL = null;
        $orgNumberFromSQL = null;
        $imageFromSQL = null;
        $startupPhaseFromSQL = null;
        $lookingForFromSQL = null;
        $specificationFromSQL = null;
        $websiteURLFromSQL = null;
        $twitterHandleFromSQL = null;
        $instagramHandleFromSQL = null;
        $facebookHandleFromSQL = null;

        $stmtGetUserdata = "SELECT email, name, phoneNumber, address, description, country, orgNumber, image, 
                                   startupPhase, lookingFor, specification, websiteURL, twitterHandle, instagramHandle, facebookHandle 
                            FROM users
                            WHERE id_user = ?";
        $stmtGetUserdata = $connen->prepare($stmtGetUserdata);
        $stmtGetUserdata->bind_param('i', $id_user);
        $stmtGetUserdata->execute();
        $stmtGetUserdata->bind_result($emailFromSQL, $nameFromSQL, $phoneNumberFromSQL, $addressFromSQL, $descriptionFromSQL, $countryFromSQL, $orgNumberFromSQL, $imageFromSQL,
                                      $startupPhaseFromSQL, $lookingForFromSQL, $specificationFromSQL, $websiteURLFromSQL, $twitterHandleFromSQL, $instagramHandleFromSQL, $facebookHandleFromSQL);
        $stmtGetUserdata->store_result();
        $stmtGetUserdata->fetch();

        $user->__set('email', $emailFromSQL);
        $user->__set('name', $nameFromSQL);
        $user->__set('phoneNumber', $phoneNumberFromSQL);
        $user->__set('address', $addressFromSQL);
        $user->__set('description', $descriptionFromSQL);
        $user->__set('country', $countryFromSQL);
        $user->__set('orgNumber', $orgNumberFromSQL);
        $user->__set('image', $imageFromSQL);
        $user->__set('startupPhase', $startupPhaseFromSQL);
        $user->__set('lookingFor', $lookingForFromSQL);
        $user->__set('specification', $specificationFromSQL);
        $user->__set('websiteURL', $websiteURLFromSQL);
        $user->__set('twitterHandle', $twitterHandleFromSQL);
        $user->__set('instagramHandle', $instagramHandleFromSQL);
        $user->__set('facebookHandle', $facebookHandleFromSQL);

    }

    if ($_SESSION['userdata']->__get('typeOfUser') == 1) {
        $formOutput = '
        
        ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 2) {
        $formOutput = '
        
        ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 3) {
        $formOutput = '
        
        ';
    }

    $conn = getDb();
    $user__Id = $_SESSION['userdata']->__get('id_user');

    $stmtGetProfilePicture = "SELECT name FROM images WHERE userId = ?";
    $stmtGetProfilePicture = $conn->prepare($stmtGetProfilePicture);
    $stmtGetProfilePicture->bind_param('i', $user__Id);
    $stmtGetProfilePicture->execute();
    $stmtGetProfilePicture->bind_result($image);
    $stmtGetProfilePicture->store_result();
    $stmtGetProfilePicture->fetch();

    $image_src = "profile/profilePictures/".$image;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="partsOfWebsite/css/profile.css">
    <link rel="stylesheet" type="text/css" href="global/common.css">
    <script src="https://kit.fontawesome.com/397d207bea.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/84fdcc201f.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- HERE COMES <NAV/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/nav.php"; ?>

    <main>
        <div class="pageWrapper">
            <div class="alignLeft">
                <div class="profileCard">

                    <a href="profile/changeProfilePicture.php"><img src='<?php echo $image_src;  ?>' id="profilePicture" alt="profile picture"width="150" height="150"></a>

                    <!--<a href="profile/changeProfilePicture.php"><img src="img/pb-test.jpg" id="profilePicture" alt="profile picture"></a>-->

                    <h2><?php echo $user->__get('name')?></h2>
                    <p class="profileCardText">
                        <?php echo $user->__get('description')?>
                        <br><br>
                        <?php echo $user->__get('address')?>, <?php echo $user->__get('postalCode')?> <?php echo $user->__get('place')?>
                        <br>
                        <?php echo $user->__get('country')?>
                    </p>
                    <?php echo $fillInRestOfDataBtn; ?>
                    <?php if ($user == $_SESSION['userdata']) echo '<a href="backend/logout.php" class="logOutBtn">Log Out</a>' ?>
                    <a href="/" class="messageBtn">Message</a>
                    <?php if ($user == $_SESSION['userdata']) echo '<a href="profile/profileEditForm.php" class="editProfileBtn">Edit Profile</a>' ?>

                </div>
                <div class="links">
                    <div class="firstMargin">
                        <i class="fas fa-globe fa-lg"></i>
                        <h6>Website</h6>
                        <p class="alignToRight1"><?php echo $user->__get('websiteURL')?></p>
                    </div>
                    <div class="Margins">
                        <i class="fab fa-twitter fa-lg" style="color: deepskyblue;"></i>
                        <h6>Twitter</h6>
                        <p class="alignToRight2"><?php echo $user->__get('twitterHandle')?></p>
                    </div>
                    <div class="Margins">
                        <i class="fab fa-instagram fa-lg" style="color: hotpink;"></i>
                        <h6>Instagram</h6>
                        <p class="alignToRight3"><?php echo $user->__get('instagramHandle')?></p>
                    </div>
                    <div class="Margins">
                        <i class="fab fa-facebook-f fa-lg" style="color: dodgerblue"></i>
                        <h6>Facebook</h6>
                        <p class="alignToRight4"><?php echo $user->__get('facebookHandle')?></p>
                    </div>
                </div>
            </div>
            <div class="userInfo">
                <div class="firstMargin">
                    <h6>Full Name</h6>
                    <p class="displayTop1"><?php echo $user->__get('name')?></p>
                </div>
                <hr>
                <div class="Margins">
                    <h6>Email</h6>
                    <p class="displayTop2"><?php echo $user->__get('email')?></p>
                </div>
                <hr>
                <div class="Margins">
                    <h6>Phone</h6>
                    <p class="displayTop3"><?php echo $user->__get('phoneNumber')?></p>
                </div>
                <hr>
                <div class="Margins">
                    <h6>Address</h6>
                    <p class="displayTop4"><?php echo $user->__get('address')?></p>
                </div>
                <hr>
                <div class="Margins">
                    <h6>Organization Number</h6>
                    <p class="displayTop5"><?php echo $user->__get('orgNumber')?></p>
                </div>
                <hr>
                <div class="Margins">
                    <h6>startup Phase</h6>
                    <p class="displayTop6"><?php echo $user->__get('numOfEmp')?></p>
                </div>
                <hr>
                <div class="Margins">
                    <h6>Description</h6>
                    <p class="displayTop7"><?php echo $user->__get('description')?></p>
                </div>
                <hr>
                <div class="Margins">
                    <h6>Looking for</h6>
                    <p class="displayTop8"><?php echo $user->__get('lookingFor')?></p>
                </div>
                <hr>
                <div class="Margins">
                    <h6>Specification</h6>
                    <p class="displayTop9"><?php echo $user->__get('specification')?></p>
                </div>
            </div>
        </div>
    </main>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "partsOfWebsite/footer.php" ?>
</body>
</html>