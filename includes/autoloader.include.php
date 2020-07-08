<?php

    spl_autoload_register('myAutoload');

    function myAutoload($className){
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if (strpos($url, 'pages') !== false || strpos($url, 'ajax') !== false || strpos($url, 'layouts') !== false) {
            $path = "../classes/";
        } else {
            $path = "classes/";
        }
        
        $extension = ".class.php";
        $fullPath = $path.$className.$extension;

        if (!file_exists($fullPath)) {
            return false;
        }
        require_once $fullPath;
    }