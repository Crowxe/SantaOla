<?php namespace Config;


    define("ROOT", dirname(__DIR__));
    define("FRONT_ROOT","/SantaOla/");
    define("VIEWS_PATH", "view/");
    define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
    define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
    define("LIB_PATH", FRONT_ROOT.VIEWS_PATH . "lib/");
    define("ADD_PATH", VIEWS_PATH . "add/");
    define("LIST_PATH", VIEWS_PATH . "list/");
    define("UPDATE_PATH", VIEWS_PATH . "update/");

    define("IMG_PATH", FRONT_ROOT.VIEWS_PATH ."img/");

    define("DB_HOST", "localhost");
    define("DB_NAME", "santaola");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("IMAGESTABLE", "images");

?>
