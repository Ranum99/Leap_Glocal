<?php
    include_once '../../backend/session.php';
    include_once 'backend/getAllQuestion.php';

    $display = "none";

    if (isset($_GET['question']) && $_GET['question'])
        $display = "block";

    questions();

    $answeredOuput = '';
    for ($i=0; $i<sizeof($answered); $i++)
        $answeredOuput .= $answered[$i];

    $unAnsweredOuput = '';
    for ($i=0; $i<sizeof($unAnswered); $i++)
        $unAnsweredOuput .= $unAnswered[$i];

    $hasOffersOutput = '';
    for ($i=0; $i<sizeof($hasOffers); $i++)
        $hasOffersOutput .= $hasOffers[$i];
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
    <a href="?question=true" class="asButton">Ny</a>
    <section id="questionsFromUser">
        <div>
            <h2>Ingen svar:</h2>
            <?php echo $unAnsweredOuput; ?>
        </div>
        <div>
            <h2>Tilbud</h2>
            <?php echo $hasOffersOutput; ?>
        </div>
        <div id="unOffered">
            <h2>Valgt</h2>
            <?php echo $answeredOuput; ?>
        </div>
    </section>
</main>

<section>
    <form action="backend/addQuestion.php" method="post" style="display: <?php echo $display?>">
        <label for="typeOfSpecification"></label>
        <select name="specification" id="typeOfSpecification">
            <option value="1">IT</option>
            <option value="2">Økonomi</option>
        </select>

        <label for="heading">Tittel</label>
        <input type="text" id="heading" name="heading">

        <label for="question">Tittel</label>
        <textarea id="question" name="question"></textarea>

        <button>Send spørsmål</button>
    </form>
</section>


<!-- HERE COMES <FOOTER/> FROM PHP FILE -->
<?php include_once "../../partsOfWebsite/footer.php"?>
</body>
</html>