<?php
    // Include the database configuration file
    include_once '../../backend/db.php';
    include_once '../../backend/session.php';

    $statusMsg = '';

    // File upload path
    $targetDir = "../profilePictures/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)) {
            // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $userId = $_SESSION['userdata']->__get('id_user');
                $conn = getDb();

                $stmtInsertImageToDB = "UPDATE users SET image = ? WHERE id_user = ?";
                $stmtInsertImageToDB = $conn->prepare($stmtInsertImageToDB);
                $stmtInsertImageToDB->bind_param('si', $fileName, $userId);
                $stmtInsertImageToDB->execute();
                $stmtInsertImageToDB->close();

                setRestOfSession_updateImage($fileName);

                if($stmtInsertImageToDB) {
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    // Display status message
    echo $statusMsg;
?>