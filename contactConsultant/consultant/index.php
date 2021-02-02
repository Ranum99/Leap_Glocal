<?php
    include_once '../../backend/session.php';
    include_once 'backend/getAllQuestions.php';

    $answeredQuesitons = get_answeredQuesitons();

    $unansweredQuesitons = get_unansweredQuesitons();

    $display = "none";
    if (isset($_GET['offer']) && $_GET['offer'])
        $display = "block";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../../global/common.css">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<!-- HERE COMES <NAV/> FROM PHP FILE -->
<?php include_once "../../partsOfWebsite/nav.php"?>

<main>
    <section id="questionsFromUsers">
        <article>
            <h2>Besvarte spørsmål:</h2>
            <?php echo $answeredQuesitons; ?>
        </article>
        <article>
            <h2>Ubesvarte spørmål:</h2>
            <?php echo $unansweredQuesitons; ?>
        </article>
    </section>
</main>




<!-- HERE COMES <FOOTER/> FROM PHP FILE -->
<?php include_once "../../partsOfWebsite/footer.php"?>
</body>
</html>