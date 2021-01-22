<?php
    include_once 'session.php';

    session_start();
    session_unset();
    session_destroy();
    header('LOCATION: ../index.php');