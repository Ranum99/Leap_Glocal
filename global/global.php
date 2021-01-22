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