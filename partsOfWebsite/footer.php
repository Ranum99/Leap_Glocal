<?php

    if (isset($_GET['lang'])) {
        if ($_GET['lang'] == "nor")
            $_SESSION['lang'] = "nor";
        if ($_GET['lang'] == "eng")
            $_SESSION['lang'] = "eng";
    }

    if (isset($_SESSION['lang']) && $_SESSION["lang"] == "nor") {
        include '\xampp\htdocs\skole\leap-glocal\backend\languages\lang_nor.php';
        $options = '
                <option value="nor" selected>Norsk</option>
                <option value="eng">English</option>
            ';
    } else {
        include '\xampp\htdocs\skole\leap-glocal\backend\languages\lang_eng.php';
        $options = '
                <option value="nor">Norsk</option>
                <option value="eng" selected>English</option>
            ';
    }

    echo '
    <footer class="container">
        <div class="flex-child">
            <h1 class="h1-footer-logo">Leap Glocal</h1>
            <p class="p-footer">Hjelper deg gjennom prosessen fra ide til bedrift</p>
             <script>
                function updateGetParameter(newValue) {
                    let url = new URL(location);
                    let url_GET_params = url.searchParams;
                
                    url_GET_params.set("lang", newValue);
                    url.search = url_GET_params.toString();
                
                    window.location.href = url.toString();
                }
             </script>
        </div>
        
        <div class="flex-child">
            <h1 class="h1-footer">Lorem Ipsum</h1>
        </div>
       
        <div class="flex-child">
            <h1 class="h1-footer">Bytt Språk</h1>
            
            <form method="get" action="" id="form_lang">
                <select name="lang" onchange="updateGetParameter(this.value)">'.$options.'</select>
            </form>
        </div>
    </footer>
    ';
