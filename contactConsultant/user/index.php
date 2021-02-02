<?php
    include_once '../../backend/session.php';

    $display = "none";

    if (isset($_GET['question']) && $_GET['question'])
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
    <a href="?question=true" class="asButton">Ny</a>
    <section id="questionsFromUser">
        <article>
            <p><strong>Tittel</strong></p>
            <p><strong>Spørsmål</strong></p>
            <p><strong>Svar</strong></p>
        </article>
        <?php include_once 'backend/getAllQuestion.php'; ?>
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