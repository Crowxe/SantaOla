<?php
      namespace controller;

      include("dao\pdo\sponsorDaoPdo.php");

      use model\Sponsor as Sponsor;
      use dao\pdo\SponsorDaoPdo as SponsorDaoPdo;

      class SponsorController
      {
        private $sponsorDAO;

        public function __construct()
        {
          $this->sponsorDAO = new SponsorDaoPdo();
        }

        public function GetAll()
        {
          return $this->sponsorDAO->GetAll();
        }
        public function GetSponsorByDNI($dni)
        {
          return $this->sponsorDAO->GetSponsorByDNI($dni);
        }

        public function addSponsor($message = "")
        {
            try
            {
                    require_once(VIEWS_PATH."add-sponsor.php");
            }
            catch(Exception $ex)
            {
                $message = 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.\n Consulte a su Administrador o vuelva a intentarlo.';
                echo '<script type="text/javascript">confirm("'.$message.'");</script>';
                require_once(VIEWS_PATH."home.php");
            }

            }


            public function listSponsors()
            {
              try
              {
            $sponsorList = $this->sponsorDAO->GetAll();

            //  require_once(VIEWS_PATH."sponsor-list.php");
              }
              catch(Exception $ex)
            {
              $message = 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.\n Consulte a su Administrador o vuelva a intentarlo.';
              echo '<script type="text/javascript">confirm("'.$message.'");</script>';
              require_once(VIEWS_PATH."home.php");
            }
          }

          public function Add($name, $description, $dni)
          {

              //lo de la imagen lo hago después, no viene por parametro
              try
              {
                  $sponsor = new Sponsor();
                  $sponsor->setName($name);
                  $sponsor->setDescription($description);
                  $sponsor->setDni($dni);


                  if($this->sponsorDAO->GetSponsorByDNI($sponsor->getDni()) == null)
                  {
                      $this->sponsorDAO->Add($sponsor);
                      $message = "Sponsor agregado con éxito";
                  }
                  else
                      $message = "Ya existe la persona que intenta ingresar";

                  $this->listSponsors($message);
              }
              catch(Exception $ex)
              {
                  $message = 'Oops ! \n\n Hubo un problema al intentar agregar la persona.\n Consulte a su Administrador o vuelva a intentarlo.';
                  echo '<script type="text/javascript">confirm("'.$message.'");</script>';
                  require_once(VIEWS_PATH."home.php");
              }
          }

          public function moveImage($name){
                $imageDirectory = VIEWS_PATH.'img/sponsors/';

                if(!file_exists($imageDirectory)){

                    mkdir($imageDirectory);
                }

                if($_FILES and $_FILES['image']['size']>0){

                    if((isset($_FILES['image'])) && ($_FILES['image']['name'] != '')){

                        $file = $imageDirectory . $name . "." . $this->obtenerExtensionFichero($_FILES['image']['name']);
                        move_uploaded_file($_FILES["image"]["tmp_name"], $file);
                        /*
                        if(!file_exists($file)){
                            move_uploaded_file($_FILES["image"]["tmp_name"], $file);
                        }
                        */
                        return $file;
                    }
                }else{
                    return null;
                }
            }

          public function Delete($dni)
            {
                try
                {
                    $this->sponsorDAO->LogicalDelete($dni);

                    $this->listSponsors();
                }
                catch(Exception $ex)
                {
                    $message = 'Oops ! \n\n Hubo un problema al intentar eliminar la persona.\n Consulte a su Administrador o vuelva a intentarlo.';
                    echo '<script type="text/javascript">confirm("'.$message.'");</script>';
                    require_once(VIEWS_PATH."home.php");
                  }
              }


          public function ShowException(){
              try
              {
                  $message = "";

                  $this->sponsorDAO->ShowException();
              }
              catch(Exception $ex)
              {
                  $message = 'Oops ! \n\n Hubo un problema de tipo Exception.\n Consulte a su Administrador.';
                  echo '<script type="text/javascript">confirm("'.$message.'");</script>';
                  require_once(VIEWS_PATH."home.php");
              }
          }



        }





 ?>
