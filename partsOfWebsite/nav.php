<?php

    if (isset($_SESSION['userdata']) && sizeof($_SESSION) > 0) {
        $hassedUserId = md5($_SESSION['userdata']->__get('id_user'));
        $linkForConsultant = '<a href="\skole\leap-glocal\contactConsultant\user\">Kontakt en konsulent</a>';

        if ($_SESSION['userdata']->__get('typeOfUser') == 2) {
            $linkForConsultant = '<a href="\skole\leap-glocal\contactConsultant\consultant\">Mulige spørsmål</a>';
        }
        echo '
        <script src="https://kit.fontawesome.com/397d207bea.js" crossorigin="anonymous"></script>
        <div class="navDiv">
            <nav>
                <a href="/skole/leap-glocal"><img alt="Leap Glocal logo" src="/skole/leap-glocal/img/leap_logo_full.png"></a>
                <section class="mainNavigation">
                    <a href="">Finn andre gründere</a>
                    <a href="">Gründerhubber/akseleratorer</a>
                    <a href="">Støtteordninger</a>
                    '.$linkForConsultant.'
                </section>
                <section style="font-size: 0.5rem;">
                    <a class="profileButton" href="/skole/leap-glocal/profile.php?user='.$hassedUserId.'"> <i class="fas fa-user-circle fa-7x" style="color: white"></i></a>
                </section>
            </nav>
        </div>
        ';
    } else {
        echo '
        <script src="https://kit.fontawesome.com/397d207bea.js" crossorigin="anonymous"></script>
        <div class="navDiv">
            <nav>
                <a href="/skole/leap-glocal"><img alt="Leap Glocal logo" src="/skole/leap-glocal/img/leap_logo_full.png"></a>
                <section>NAV ELEMENTER</section>
                <section class="buttonWrapper">
                    <a class="loginBtn" href="/skole/leap-glocal/loginRegister/login.php">Logg inn</a>
                    <a class="registerBtn" href="/skole/leap-glocal/loginRegister/register.php">Bli medlem</a>
                </section>
            </nav>
        </div>
        ';
    }
