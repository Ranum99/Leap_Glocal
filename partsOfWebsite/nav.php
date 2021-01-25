<?php
    if (sizeof($_SESSION) > 0) {
        echo '
        <nav>
            <a href="/skole/leap-glocal"><img alt="Leap Glocal logo" src="/skole/leap-glocal/img/leap_logo_full.png"></a>
            <section>NAV ELEMENTER</section>
            <section>
                <a class="asButton" href="/skole/leap-glocal/profile.php">'.$_SESSION['userdata']->__get('name').'</a>
            </section>
        </nav>
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
        ';
    }
