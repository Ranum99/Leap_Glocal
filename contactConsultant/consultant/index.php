<?php
    include_once '../../backend/session.php';
    include_once 'backend/getAllQuestions.php';

    $get_myJobs = get_myJobs();

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

    <script src="https://kit.fontawesome.com/397d207bea.js" crossorigin="anonymous"></script>
</head>
<body>
<!-- HERE COMES <NAV/> FROM PHP FILE -->
<?php include_once "../../partsOfWebsite/nav.php"?>

<main>
    <section id="questionsFromUsers">
        <article>
            <h2>Dine oppdrag:</h2>
            <div>
                <?php echo $get_myJobs; ?>
            </div>
        </article>
        <article>
            <h2>Besvarte spørsmål:</h2>
            <div>
                <?php echo $answeredQuesitons; ?>
            </div>
        </article>
        <article>
            <h2>Ubesvarte spørmål:</h2>
            <div>
                <?php echo $unansweredQuesitons; ?>
            </div>
        </article>
    </section>
</main>




<!-- HERE COMES <FOOTER/> FROM PHP FILE -->
<?php include_once "../../partsOfWebsite/footer.php"?>
</body>
</html>