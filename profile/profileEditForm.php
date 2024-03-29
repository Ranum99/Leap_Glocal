<?php
    include_once '../backend/session.php';
    include_once '\xampp\htdocs\skole\leap-glocal\loginRegister\backend\registerUserBack.php';

    if ($_SESSION['userdata']->__get('typeOfUser') == 1) {
        $formOutput = '
                <label for="telefon_register">Telefon</label>
                <input type="tel" id="telefon_register" name="telephone" value="'.$_SESSION['userdata']->__get('phoneNumber').'" />      
    
                <label for="specification_register">Spesifikasjoner</label>
                <input type="text" id="specification_register" name="specification" value="'.$_SESSION['userdata']->__get('specification').'">
                <div id="specOutput"></div>
                
                <label for="numbOfEmp_register">Antall ansatte</label>
                <select id="numbOfEmp_register" name="numbOfEmp">
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 1 ? "selected" : "").' value="1" selected>1-10</option>
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 2 ? "selected" : "").' value="2">11-50</option>
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 3 ? "selected" : "").' value="3">51-100</option>
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 4 ? "selected" : "").' value="4">101-200</option>
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 5 ? "selected" : "").' value="5">200+</option>
                </select>
                
                <label for="benefits_register">Fordeler ved å knytte seg til oss</label>
                <textarea id="benefits_register" name="benefits">'.$_SESSION['userdata']->__get('benefits').'</textarea>
    
                <label for="description_register">En beskrivelse av bedriften</label>
                <textarea id="description_register" name="description">'.$_SESSION['userdata']->__get('description').'</textarea>
    
                <label for="webURL_register">Nettside url</label>
                <input type="url" id="webURL_register" name="webURL" value="'.$_SESSION['userdata']->__get('websiteURL').'"/>
    
                <label for="postalCode_register">Postnummer</label>
                <input type="number" maxlength="4" id="postalCode_register" name="postalCode" value="'.$_SESSION['userdata']->__get('postalCode').'" />
    
                <label for="address_register">Adresse</label>
                <input type="text" id="address_register" name="address" value="'.$_SESSION['userdata']->__get('address').'"/>
    
                <label for="orgnumber_register">Organisasjonsnummer</label>
                <input type="number" maxlength="9" id="orgnumber_register" name="orgnumber" value="'.$_SESSION['userdata']->__get('orgNumber').'"/>
            ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 2) {
        $formOutput = '
                <label for="telefon_register">Telefon</label>
                <input type="tel" id="telefon_register" name="telephone" value="'.$_SESSION['userdata']->__get('phoneNumber').'"/>      
    
                <label for="specification_register">Spesifikasjoner</label>
                <input type="text" id="specification_register" name="specification" value="'.$_SESSION['userdata']->__get('specification').'">
                <div id="specOutput"></div>
    
                <label for="description_register">En beskrivelse av bedriften</label>
                <textarea id="description_register" name="description">'.$_SESSION['userdata']->__get('description').'</textarea>
    
                <label for="webURL_register">Nettside url</label>
                <input type="url" id="webURL_register" name="webURL" value="'.$_SESSION['userdata']->__get('websiteURL').'"/>
    
                <label for="age_register">Alder *</label>
                <input type="number" id="age_register" name="age" value="'.$_SESSION['userdata']->__get('age').'"/>
    
                <label for="levelOfXp_register">Erfargingsnivå</label>
                <select id="levelOfXp_register" name="levelOfXp">
                    <option '.($_SESSION['userdata']->__get('levelOfExperience') == 1 ? "selected" : "").' value="1" selected>Flink</option>
                    <option '.($_SESSION['userdata']->__get('levelOfExperience') == 2 ? "selected" : "").' value="2">Flinkere</option>
                    <option '.($_SESSION['userdata']->__get('levelOfExperience') == 3 ? "selected" : "").' value="3">Flinkest</option>
                </select>
            ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 3) {
        $formOutput = '
                <label for="telefon_register">Telefon</label>
                <input type="tel" id="telefon_register" name="telephone" value="'.$_SESSION['userdata']->__get('phoneNumber').'" />
                
                <label for="numbOfEmp_register">Antall ansatte</label>
                <select id="numbOfEmp_register" name="numbOfEmp">
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 1 ? "selected" : "").' value="1" selected>1-10</option>
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 2 ? "selected" : "").' value="2">11-50</option>
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 3 ? "selected" : "").' value="3">51-100</option>
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 4 ? "selected" : "").' value="4">101-200</option>
                    <option '.($_SESSION['userdata']->__get('numOfEmp') == 5 ? "selected" : "").' value="5">200+</option>
                </select>
                
                <label for="gender_register">Kjønn</label>
                <select id="gender_register" name="gender" >
                    <option '.($_SESSION['userdata']->__get('gender') == "man" ? "selected" : "").' value="man" selected>Mann</option>
                    <option '.($_SESSION['userdata']->__get('gender') == "woman" ? "selected" : "").' value="woman">Kvinne</option>
                    <option '.($_SESSION['userdata']->__get('gender') == "null" ? "selected" : "").' value="null">Ønsker ikke å oppgi</option>
                </select>
                
                <label for="industry_register">Industri</label>
                <select id="industry_register" name="industry" >
                    <option '.($_SESSION['userdata']->__get('industry') == 1 ? "selected" : "").' value="1" selected>IT</option>
                    <option '.($_SESSION['userdata']->__get('industry') == 2 ? "selected" : "").' value="2">Økonomi</option>
                </select>
                
                <label for="startupPhase_register">Oppstartsfase</label>
                <select id="startupPhase_register" name="startupPhase" >
                    <option '.($_SESSION['userdata']->__get('startupPhase') == 1 ? "selected" : "").' value="1" selected>Ide fase</option>
                    <option '.($_SESSION['userdata']->__get('startupPhase') == 2 ? "selected" : "").' value="2">Produkt eller prototype</option>
                    <option '.($_SESSION['userdata']->__get('startupPhase') == 3 ? "selected" : "").' value="3">Gå til marked</option>
                    <option '.($_SESSION['userdata']->__get('startupPhase') == 4 ? "selected" : "").' value="4">Vekst og ekspansjon</option>
                </select>
                
                <label for="lookingFor_register">Hva du leter etter</label>
                <select id="lookingFor_register" name="lookingFor" >
                    <option '.($_SESSION['userdata']->__get('lookingFor') == 1 ? "selected" : "").' value="1" selected>Ingen</option>
                    <option '.($_SESSION['userdata']->__get('lookingFor') == 2 ? "selected" : "").' value="2">Støtte</option>
                    <option '.($_SESSION['userdata']->__get('lookingFor') == 3 ? "selected" : "").' value="3">Mentor</option>
                    <option '.($_SESSION['userdata']->__get('lookingFor') == 4 ? "selected" : "").' value="4">Medgründer</option>
                    <option '.($_SESSION['userdata']->__get('lookingFor') == 5 ? "selected" : "").' value="5">Annet</option>
                </select>            
                
                <label for="businessModel_register">Primær businessmodell</label>
                <select id="businessModel_register" name="businessModel" >
                    <option '.($_SESSION['userdata']->__get('businessModel') == 1 ? "selected" : "").' value="1" selected>B2C</option>
                    <option '.($_SESSION['userdata']->__get('businessModel') == 2 ? "selected" : "").' value="2">B2B</option>
                    <option '.($_SESSION['userdata']->__get('businessModel') == 3 ? "selected" : "").' value="3">Markedsplass</option>
                    <option '.($_SESSION['userdata']->__get('businessModel') == 4 ? "selected" : "").' value="4">B2G</option>
                </select>      
                
                <label for="title_register">Stillingstittel</label>
                <input type="text" id="title_register" name="title" value="'.$_SESSION['userdata']->__get('title').'"/>      
    
                <label for="specification_register">Spesifikasjoner</label>
                <input type="text" id="specification_register" name="specification" value="'.$_SESSION['userdata']->__get('specification').'">
                <div id="specOutput"></div>
    
                <label for="age_register">Alder</label>
                <input type="number" id="age_register" name="age" value="'.$_SESSION['userdata']->__get('age').'"/>
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
            <label for="country_register">Land</label>
            <select id="country_register" name="country" >
                <option value="Norge" selected>Norge</option>
            </select>

            <label for="name_register">Navn</label>
            <input type="text" id="name_register" name="name" value="<?php echo $_SESSION['userdata']->__get('name'); ?>" />

            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $_SESSION['userdata']->__get('email'); ?>" />

            <label for="twitter_register">Twitter brukernavn</label>
            <input type="text" id="twitter_register" name="twitter" value="<?php echo $_SESSION['userdata']->__get('twitterHandle'); ?>" />

            <label for="instagram_register">Instagram brukernavn</label>
            <input type="text" id="instagram_register" name="instagram" value="<?php echo $_SESSION['userdata']->__get('instagramHandle'); ?>" />

            <label for="facebook_register">Facebook brukernavn</label>
            <input type="text" id="facebook_register" name="facebook" value="<?php echo $_SESSION['userdata']->__get('facebookHandle'); ?>" />

            <label for="password">Passord</label>
            <input type="password" id="password" name="password" />

            <label for="confirm_password">Gjenta passord</label>
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
