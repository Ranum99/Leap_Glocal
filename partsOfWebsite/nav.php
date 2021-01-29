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

    if (isset($_SESSION['userdata']) && sizeof($_SESSION) > 0) {
        echo '
        <nav>
            <a href="/skole/leap-glocal"><img alt="Leap Glocal logo" src="/skole/leap-glocal/img/leap_logo_full.png"></a>
            <section>NAV ELEMENTER</section>
            <section>
                <a class="asButton" href="/skole/leap-glocal/profile.php">'.$_SESSION['userdata']->__get('name').'</a>
            </section>
        </nav>
        <script>function changeLang(){document.getElementById("form_lang").submit();}</script>
        <form method="get" action="" id="form_lang">
            <select name="lang" onchange="changeLang()">'.$options.'</select>
        </form>
        ';
    } else {
        echo '
        <nav>
            <a href="/skole/leap-glocal"><img alt="Leap Glocal logo" src="/skole/leap-glocal/img/leap_logo_full.png"></a>
            <section>NAV ELEMENTER</section>
            <section>
                <a class="asButton" href="/skole/leap-glocal/loginRegister/login.php">Logg inn</a>
                <a class="asButton" href="/skole/leap-glocal/loginRegister/register.php">Bli medlem</a>
            </section>
        </nav>
        <script>function changeLang(){document.getElementById("form_lang").submit();}</script>
        <form method="get" action="" id="form_lang">
            <select name="lang" onchange="changeLang()">'.$options.'</select>
        </form>
        ';
    }
