<?php
    include_once '../backend/session.php';
    include_once '\xampp\htdocs\skole\leap-glocal\loginRegister\backend\registerUserBack.php';

    if ($_SESSION['userdata']->__get('typeOfUser') == 1) {
        $formOutput = '
                <label for="telefon_register">Telefon</label>
                <input type="tel" id="telefon_register" name="telephone" />      
    
                <label for="specification_register">Spesifikasjoner</label>
                <input type="text" id="specification_register" name="specification">
                <div id="specOutput"></div>
                
                <label for="numbOfEmp_register">Antall ansatte</label>
                <select id="numbOfEmp_register" name="numbOfEmp">
                    <option value="1" selected>1-10</option>
                    <option value="2">11-50</option>
                    <option value="3">51-100</option>
                    <option value="4">101-200</option>
                    <option value="5">200+</option>
                </select>
                
                <label for="benefits_register">Fordeler ved å knytte seg til oss</label>
                <textarea id="benefits_register" name="benefits"></textarea>
    
                <label for="description_register">En beskrivelse av bedriften</label>
                <textarea id="description_register" name="description"></textarea>
    
                <label for="webURL_register">Nettside url</label>
                <input type="url" id="webURL_register" name="webURL" />
    
                <label for="postalCode_register">Postnummer</label>
                <input type="number" maxlength="4" id="postalCode_register" name="postalCode" />
    
                <label for="address_register">Adresse</label>
                <input type="text" id="address_register" name="address" />
    
                <label for="orgnumber_register">Organisasjonsnummer</label>
                <input type="number" maxlength="9" id="orgnumber_register" name="orgnumber" />
            ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 2) {
        $formOutput = '
                <label for="telefon_register">Telefon</label>
                <input type="tel" id="telefon_register" name="telephone" />      
    
                <label for="specification_register">Spesifikasjoner</label>
                <input type="text" id="specification_register" name="specification">
                <div id="specOutput"></div>
    
                <label for="description_register">En beskrivelse av bedriften</label>
                <textarea id="description_register" name="description"></textarea>
    
                <label for="webURL_register">Nettside url</label>
                <input type="url" id="webURL_register" name="webURL" />
    
                <label for="age_register">Alder *</label>
                <input type="number" id="age_register" name="age" />
    
                <label for="levelOfXp_register">Erfargingsnivå</label>
                <select id="levelOfXp_register" name="levelOfXp">
                    <option value="1" selected>Flink</option>
                    <option value="2">Flinkere</option>
                    <option value="3">Flinkest</option>
                </select>
            ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 3) {
        $formOutput = '
                <label for="telefon_register">Telefon</label>
                <input type="tel" id="telefon_register" name="telephone" value="'.$telephone_post.'" />
                
                <label for="numbOfEmp_register">Antall ansatte</label>
                <select id="numbOfEmp_register" name="numbOfEmp">
                    <option value="1">1-10</option>
                    <option value="2">11-50</option>
                    <option value="3">51-100</option>
                    <option value="4">101-200</option>
                    <option value="5">200+</option>
                </select>
                
                <label for="gender_register">Kjønn</label>
                <select id="gender_register" name="gender" >
                    <option value="man" selected>Mann</option>
                    <option value="woman">Kvinne</option>
                    <option value="null">Ønsker ikke å oppgi</option>
                </select>
                
                <label for="industry_register">Industri</label>
                <select id="industry_register" name="industry" >
                    <option value="1" selected>IT</option>
                    <option value="2">Økonomi</option>
                </select>
                
                <label for="startupPhase_register">Oppstartsfase</label>
                <select id="startupPhase_register" name="startupPhase" >
                    <option value="1" selected>Ide fase</option>
                    <option value="2">Produkt eller prototype</option>
                    <option value="3">Gå til marked</option>
                    <option value="4">Vekst og ekspansjon</option>
                </select>
                
                <label for="lookingFor_register">Hva du leter etter</label>
                <select id="lookingFor_register" name="lookingFor" >
                    <option value="1" selected>Ingen</option>
                    <option value="2">Støtte</option>
                    <option value="3">Mentor</option>
                    <option value="4">Medgründer</option>
                    <option value="5">Annet</option>
                </select>            
                
                <label for="businessModel_register">Primær businessmodell</label>
                <select id="businessModel_register" name="businessModel" >
                    <option value="1" selected>B2C</option>
                    <option value="2">B2B</option>
                    <option value="3">Markedsplass</option>
                    <option value="4">B2G</option>
                </select>      
                
                <label for="title_register">Stillingstittel</label>
                <input type="text" id="title_register" name="title" />      
    
                <label for="specification_register">Spesifikasjoner</label>
                <input type="text" id="specification_register" name="specification">
                <div id="specOutput"></div>
    
                <label for="age_register">Alder</label>
                <input type="number" id="age_register" name="age" />
            ';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../global/common.css">
    <link rel="stylesheet" type="text/css" href="css/profileEditForm.css">
    <script src="../loginRegister/specs.js"></script>
</head>
<body>
<!-- HERE COMES <NAV/> FROM PHP FILE -->
<?php include_once "../partsOfWebsite/nav.php"?>

<main>
    <!-- Fill in remaining info -->
    <div id="wrapper">
        <h1>Rediger profil</h1>

        <form action="" method="post" id="wrapper2">
            <label for="image_register">Bilde</label>
            <input type="file" accept="image/png, image/jpeg" id="image_register" name="image" />

            <label for="country_register">Land</label>
            <select id="country_register" name="country" >
                <option value="NOR" selected>Norge</option>
            </select>

            <label for="name_register">Navn</label>
            <input type="text" id="name_register" name="name" />

            <label for="email">Email</label>
            <input type="text" id="email" name="email" />

            <label for="twitter_register">Twitter brukernavn</label>
            <input type="text" id="twitter_register" name="twitter" />

            <label for="instagram_register">Instagram brukernavn</label>
            <input type="text" id="instagram_register" name="instagram" />

            <label for="facebook_register">Facebook brukernavn</label>
            <input type="text" id="facebook_register" name="facebook" />

            <label for="password">Passord</label>
            <input type="password" id="password" name="password" />

            <label for="confirm_password">Facebook brukernavn</label>
            <input type="password" id="confirm_password" name="confirm_password" />

            <?php echo $formOutput; ?>

            <p id="errorMessage"><?php echo $error; ?></p>

            <button id="button">Legg til info</button>
        </form>
    </div>
</main>

<!-- HERE COMES <FOOTER/> FROM PHP FILE -->
<?php include_once "../partsOfWebsite/footer.php"?>
</body>
</html>
