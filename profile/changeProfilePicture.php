<?php
include_once '../backend/db.php';
include_once '../backend/session.php';

if(isset($_POST['but_upload'])){

    $name = $_FILES['file']['name'];
    $target_dir = "profilePictures/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if (in_array($imageFileType,$extensions_arr) ){

        $id_user = $_SESSION['userdata']->__get('id_user');
        $conn = getDb();

        $dbh = getDb();
        $stmtCheckForId = $dbh->prepare("SELECT userId FROM images WHERE userId = ?");
        $stmtCheckForId->bind_param('i', $id_user);
        $stmtCheckForId->execute();

        if($stmtCheckForId->rowCount() > 0) {
            $stmtUpdateImage = "UPDATE images SET name = ? WHERE userId = ?";
            $stmtUpdateImage = $conn->prepare($stmtUpdateImage);
            $stmtUpdateImage->bind_param('si', $name, $id_user);
            $stmtUpdateImage->execute();
            $stmtUpdateImage->close();
        } else {
            $stmtInsertImage = "INSERT INTO images (name, userId) VALUES(?, ?)";
            $stmtInsertImage = $conn->prepare($stmtInsertImage);
            $stmtInsertImage->bind_param('si', $name, $id_user);
            $stmtInsertImage->execute();
        }

        $stmtCheckId = "SELECT userId FROM images WHERE userID = ?";
        $stmtCheckId =  $conn->prepare($stmtCheckId);
        $stmtCheckId->bind_param('i', $id_user);
        $stmtCheckId->execute();
        $stmtCheckId->close();

        if(mysqli_num_rows($stmtCheckId) > 0)
        {
            // row exists. do whatever you would like to do.
        }

        // Insert record
        // $query = "insert into images(name) values('".$name."')";
        // mysqli_query($conn,$query);

        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

    }

}
?>

<form method="post" action="" enctype='multipart/form-data'>
    <input type='file' name='file' />
    <input type='submit' value='Bytt bilde' name='but_upload'>
</form>