<?php
    include_once '../backend/session.php';

    if (getDataFromSessionColumn_userdata("requiredColumnsFilled") == 1) {
        include_once '../global/global.php';
        goback();
    }

    if ($_SESSION['userdata']->__get('typeOfUser') == 1) {
        $formOutput = '
            <form action="backend/registerUserBack.php" method="post">
                <label for="telefon_register">Telefon *</label>
                <input type="tel" id="telefon_register" name="telephone" required placeholder="123 45 678" />
    
                <label for="specification_register">Spesifikasjon *</label>
                <select id="specification_register" name="specification" required>
                    <option value="1" selected>Litt</option>
                    <option value="2">Mer</option>
                    <option value="3">Mest</option>
                </select>
    
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
    
                <button>Legg til info</button>
            </form>
        ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 2) {
        $formOutput = '
            <form action="backend/registerUserBack.php" method="post">
                <label for="telefon_register">Telefon *</label>
                <input type="tel" id="telefon_register" name="telephone" required placeholder="123 45 678" />
    
                <label for="specification_register">Spesifikasjon *</label>
                <select id="specification_register" name="specification" required>
                    <option value="1" selected>Litt</option>
                    <option value="2">Mer</option>
                    <option value="3">Mest</option>
                </select>
    
                <label for="description_register">Beskrivelse </label>
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
                
                <button>Legg til info</button>
            </form>
        ';
    } else if ($_SESSION['userdata']->__get('typeOfUser') == 3) {
        $formOutput = '
            <form action="backend/registerUserBack.php" method="post">
                <label for="telefon_register">Telefon</label>
                <input type="tel" id="telefon_register" name="telephone" required placeholder="123 45 678" />
    
                <label for="specification_register">Spesifikasjon *</label>
                <select id="specification_register" name="specification" required>
                    <option value="1" selected>Litt</option>
                    <option value="2">Mer</option>
                    <option value="3">Mest</option>
                </select>
    
                <label for="age_register">Alder *</label>
                <input type="number" id="age_register" name="age" required placeholder="18" />
                
                <button>Legg til info</button>
            </form>
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
</head>
<body>
    <!-- HERE COMES <NAV/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/nav.php"?>

    <main>
        <!-- Fill in remaining info -->
        <h1>Fyll inn resterende info</h1>
        <?php echo $formOutput; ?>
    </main>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/footer.php"?>
</body>
</html>