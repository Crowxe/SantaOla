<?php
    namespace Config;

    class Autoload
    {
        public static function start()
        {
            spl_autoload_register(function ($className)
            {
                //echo $className."<br>";
                $fileName = str_replace("\\", "/", ROOT."/".$className.".php");

                //echo $fileName."<br>";

                require($fileName);
            });
        }
    }


?>
