<?php namespace controller;

    class HomeController
    {
        public function Index()
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function Logout()
        {
            session_destroy();

            $this->Index();
        }
    }
?>
