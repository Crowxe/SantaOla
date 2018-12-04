<?php
namespace Config;

    class Router {

        /**
         * Se encarga de direccionar a la pagina solicitada
         * @param Request
         */
        public function __construct()
        {

        }
        public static function direccionar(Request $request)
        {


            $controlador = $request->getControladora()."Controller";
            $metodo = $request->getMetodo();


            $parametros = $request->getParametros();


            $objeto = "Controller\\". $controlador;
            $controlador = new $objeto();

            if(!isset($parametros))

            {
                call_user_func(array($controlador, $metodo));
            } else
            {
                call_user_func_array(array($controlador, $metodo),$parametros);
            }
        }
    }
 ?>
