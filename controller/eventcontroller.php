<?php
  namespace controller;

  use excepcions\WrongAtributeException;
  use dao\pdo\EventDaoPdo;
  use model\Event as Event;

  class EventController
  {

    private $eventDAO;

    function __construct()
    {
      this->$eventDAO = new EventDaoPdo();
    }

    public function addEvent($message = "")
    {
        try
        {
                require_once(VIEWS_PATH."add-event.php");
        }
        catch(Exception $ex)
        {
            $message = 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.\n Consulte a su Administrador o vuelva a intentarlo.';
            echo '<script type="text/javascript">confirm("'.$message.'");</script>';
            require_once(VIEWS_PATH."home.php");
        }

        }


        public function listEvents()
        {
          try
          {
              $eventList = $this->eventDAO->GetAll();

          require_once(VIEWS_PATH."event-list.php");
          }
          catch(Exception $ex)
        {
          $message = 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.\n Consulte a su Administrador o vuelva a intentarlo.';
          echo '<script type="text/javascript">confirm("'.$message.'");</script>';
          require_once(VIEWS_PATH."home.php");
        }
      }


      public function Add($title, $description, $date)
      {

          //lo de la imagen lo hago después, no viene por parametro
          try
          {
              $event = new Event();
              $event->setName($name);
              $event->setDescription($description);
              $event->setDate($date);


              if($this->eventDAO->GetEventById($event->getEventId() == null)
              {
                  $this->eventDAO->Add($event);
                  $message = "Evento agregado con éxito";
              }
              else
                  $message = "Ya existe el evento que intenta ingresar";

              $this->listEvents($message);
          }
          catch(Exception $ex)
          {
              $message = 'Oops ! \n\n Hubo un problema al intentar agregar el evento.\n Consulte a su Administrador o vuelva a intentarlo.';
              echo '<script type="text/javascript">confirm("'.$message.'");</script>';
              require_once(VIEWS_PATH."home.php");
          } // asd
      }


      public function Delete($eventId)
        {
            try
            {
                $this->eventDAO->LogicalDelete($eventId);

                $this->listEvents();
            }
            catch(Exception $ex)
            {
                $message = 'Oops ! \n\n Hubo un problema al intentar eliminar el evento.\n Consulte a su Administrador o vuelva a intentarlo.';
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
