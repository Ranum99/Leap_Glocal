<?php
    include_once '../backend/session.php';


    include_once '\xampp\htdocs\skole\leap-glocal\loginRegister\backend\registerUserBack.php';


    if ($_SESSION['userdata']->__get('typeOfUser') == 1) {
        $formOutput = '
            <label for="telefon_register">Telefon *</label>
            <input type="tel" id="telefon_register" name="telephone" required placeholder="123 45 678" />      

            <label for="specification_register">Spesifikasjoner:</label>
            <input type="text" id="specification_register" name="specification" required>
            <div id="specOutput"></div>
            
            <label for="numbOfEmp_register">Antall ansatte *</label>
            <select id="numbOfEmp_register" name="numbOfEmp" required>
                <option value="1" selected>1-10</option>
                <option value="2">11-50</option>
                <option value="3">51-100</option>
                <option value="4">101-200</option>
                <option value="5">200+</option>
            </select>
            
            <label for="benefits_register">Fordeler å knytte seg til oss</label>
            <textarea id="benefits_register" name="benefits" required placeholder="Fordeler å knytte seg til oss"></textarea>

            <label for="description_register">Beskrivelse *</label>
            <textarea id="description_register" name="description" required placeholder="En beskrivelse av bedriften"></textarea>

            <label for="webURL_register">Nettside url</label>
            <input type="url" id="webURL_register" name="webURL" required placeholder="leapnorge.no" />

            <label for="postalCode_register">Postnummer *</label>
            <input type="number" maxlength="4" id="postalCode_register" name="postalCode" required placeholder="9999" />

            <label for="address_register">Adresse *</label>
            <input type="text" id="address_register" name="address" required placeholder="Osloveien 1" />

            <label for="orgnumber_register">Organisasjonsnummer *</label>
            <input type="number" maxlength="9" id="orgnumber_register" name="orgnumber" required placeholder="123456789" />
        ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 2) {
        $formOutput = '
            <label for="telefon_register">Telefon *</label>
            <input type="tel" id="telefon_register" name="telephone" required placeholder="123 45 678" />      

            <label for="specification_register">Spesifikasjoner:</label>
            <input type="text" id="specification_register" name="specification" required>
            <div id="specOutput"></div>

            <label for="description_register">Beskrivelse</label>
            <textarea id="description_register" name="description" required placeholder="En beskrivelse av bedriften"></textarea>

            <label for="webURL_register">Nettside url</label>
            <input type="url" id="webURL_register" name="webURL" required placeholder="leapnorge.no" />

            <label for="age_register">Alder *</label>
            <input type="number" id="age_register" name="age" required placeholder="18" />

            <label for="levelOfXp_register">Erfargingsnivå *</label>
            <select id="levelOfXp_register" name="levelOfXp" required>
                <option value="1" selected>Flink</option>
                <option value="2">Flinkere</option>
                <option value="3">Flinkest</option>
            </select>
        ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 3) {
        $formOutput = '
            <label for="telefon_register">Telefon</label>
            <input type="tel" id="telefon_register" name="telephone" placeholder="123 45 678" value="'.$telephone_post.'" required />
            
            <label for="numbOfEmp_register">Antall ansatte *</label>
            <select id="numbOfEmp_register" name="numbOfEmp" required>
                <option value="1">1-10</option>
                <option value="2">11-50</option>
                <option value="3">51-100</option>
                <option value="4">101-200</option>
                <option value="5">200+</option>
            </select>
            
            <label for="gender_register">Kjønn *</label>
            <select id="gender_register" name="gender" required >
                <option value="man" selected>Mann</option>
                <option value="woman">Kvinne</option>
                <option value="null">Ønsker ikke å oppgi</option>
            </select>
            
            <label for="industry_register">Industri *</label>
            <select id="industry_register" name="industry" required >
                <option value="1" selected>IT</option>
                <option value="2">Økonomi</option>
            </select>
            
            <label for="startupPhase_register">Oppstartsfase *</label>
            <select id="startupPhase_register" name="startupPhase" required >
                <option value="1" selected>Ide fase</option>
                <option value="2">Produkt eller prototype</option>
                <option value="3">Gå til marked</option>
                <option value="4">Vekst og ekspansjon</option>
            </select>
            
            <label for="lookingFor_register">Leter du etter *</label>
            <select id="lookingFor_register" name="lookingFor" required >
                <option value="1" selected>Ingen</option>
                <option value="2">Støtte</option>
                <option value="3">Mentor</option>
                <option value="4">Medgründer</option>
                <option value="5">Annet</option>
            </select>            
            
            <label for="businessModel_register">Primær businessmodell *</label>
            <select id="businessModel_register" name="businessModel" required >
                <option value="1" selected>B2C</option>
                <option value="2">B2B</option>
                <option value="3">Markedsplass</option>
                <option value="4">B2G</option>
            </select>      
            
            <label for="title_register">Tittel *</label>
            <input type="text" id="title_register" name="title"  placeholder="CEO" required />      

            <label for="specification_register">Spesifikasjoner:</label>
            <input type="text" id="specification_register" name="specification" required>
            <div id="specOutput"></div>

            <label for="age_register">Alder *</label>
            <input type="number" id="age_register" name="age"  placeholder="18" required />
        ';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../global/common.css">
    <link rel="stylesheet" type="text/css" href="css/registerAndLogin.css">
    <script src="specs.js"></script>
</head>
<body>
    <!-- HERE COMES <NAV/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/nav.php"?>

    <main>
        <!-- Fill in remaining info -->
        <h1>Fyll inn resterende info</h1>
        <form action="" method="post">
            <label for="image_register">Bilde *</label>
            <input type="file" accept="image/png, image/jpeg" id="image_register" name="image" required />
            <label for="country_register">Land *</label>
            <select id="country_register" name="country" required >
                <option value="NOR" selected>Norge</option>
            </select>
            <?php echo $formOutput; ?>

            <p id="errorMessage"><?php echo $error; ?></p>

            <button>Legg til info</button>
        </form>
    </main>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/footer.php"?>
</body>
</html>