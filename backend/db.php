<?php
    function getHostToDatabase()
    {
        return 'localhost';
    }

    function getDbUsernameToDatabase()
    {
        return 'root';
    }

    function getDbPasswordToDatabase()
    {
        return '';
    }

    function getDbNameToDatabase()
    {
        return 'leap-glocal';
    }

    $conn = new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());

    function getDb() {
        return new mysqli(getHostToDatabase(), getDbUsernameToDatabase(), getDbPasswordToDatabase(), getDbNameToDatabase());
    }