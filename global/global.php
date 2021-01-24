<?php
    function goback()
    {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

    function existAndNotEmpty_post($var) {
        if (isset($_POST[''.$var.'']) && !empty($_POST[''.$var.''])) {
            return true;
        }
        return false;
    }

    function existAndNotEmpty_post_array($array) {
        $allIsValid = true;
        for ($i = 0; $i < sizeof($array); $i++){
            if (!isset($_POST[''.$array[$i].'']) || empty($_POST[''.$array[$i].'']))
                $allIsValid = false;
        }
        return $allIsValid;
    }