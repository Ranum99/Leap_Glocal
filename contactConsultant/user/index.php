<?php
    include_once '../../backend/session.php';
    include_once '../user/backend/getAllQuestion.php';

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
    <script src="showMessageTemplate.js"></script>

    <script src="https://kit.fontawesome.com/397d207bea.js" crossorigin="anonymous"></script>
</head>
<body>
<!-- HERE COMES <NAV/> FROM PHP FILE -->
<?php include_once "../../partsOfWebsite/nav.php"?>

<main>
    <a id="newQuestionBtn">Nytt spørsmål</a>

    <section class="questionsFromUsers">
        <article>
            <h2 class="headlines">Ingen svar</h2>
            <div class="grid-divs">
                <?php echo $unAnsweredOuput; ?>
            </div>
        </article>
        <article>
            <h2 class="headlines">Tilbud</h2>
            <div class="grid-divs">
                <?php echo $hasOffersOutput; ?>
            </div>
        </article>
        <article>
            <h2 class="headlines">Valgt</h2>
            <div class="grid-divs">
                <?php echo $answeredOuput; ?>
            </div>
        </article>
    </section>

    <section id="newQuestionSection">
        <div></div>
        <form action="backend/addQuestion.php" id="questionForm" method="post">
            <label for="typeOfSpecification">type</label>
            <select name="specification" id="typeOfSpecification" required>
                <option value="1">IT</option>
                <option value="2">Økonomi</option>
            </select>

            <label for="heading">tittel</label>
            <input type="text" id="heading" name="heading" required>

            <label for="question">spørsmål</label>
            <textarea id="question" name="question" required></textarea>

            <div class="sendQuestionWrapper">
                <button class="redButton" style="width: 300px; font-size: 18px;">Send spørsmål</button>
            </div>
        </form>
    </section>
</main>

<!-- HERE COMES <FOOTER/> FROM PHP FILE -->
<?php include_once "../../partsOfWebsite/footer.php"?>
</body>
</html>