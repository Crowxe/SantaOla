<?php
  namespace controller;

  include("dao\pdo\\eventDaoPdo.php");

  use excepcions\WrongAtributeException;
  use dao\pdo\EventDaoPdo;
  use model\Event as Event;

  class EventController
  {

    private $eventDAO;

    function __construct()
    {
      $this->eventDAO = new EventDaoPdo();
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

    public function listEvents($message)
    {
      try
      {
        $eventList = $this->eventDAO->GetAll();
        //require_once(VIEWS_PATH."event-list.php");
      } catch(Exception $ex)  {
          $message = 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.\n Consulte a su Administrador o vuelva a intentarlo.';
          echo '<script type="text/javascript">confirm("'.$message.'");</script>';
          require_once(VIEWS_PATH."home.php");
        }
        catch (EventNotFoundException e){

        }
    }

    public function UpdateEvent($title, $description, $date)
    {
      $event = new Event();
      $event->setTitle($title);
      $event->setDescription($description);
      $event->setDate($date);
      $this->eventDAO->UpdateEvent($event);
    }

    public function GetAll()
    {
      $events = $this->eventDAO->GetAll();
      if ($events != null)
        return $events;
      else
        throw new EventNotFoundException();
    }

    public function moveImage($name){
          $imageDirectory = CSS_PATH.'img/events/';

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

      public function Add($title, $description, $date)
      {
          //lo de la imagen lo hago después, no viene por parametro
          try
          {
              $event = new Event();
              $event->setTitle($title);
              $event->setDescription($description);
              $event->setDate($date);
              $idevent = $this->eventDAO->GetIdEvent($event->getTitle(),$event->getDescription());
              if($idevent == null)
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
          }
      }

      public function GetEvent($title, $description)
      {
        $idevent = $this->eventDAO->GetIdEvent($title, $description);
        $event = $this->eventDAO->GetEventById($idEvent);
        if ($event != null)
          return  $event;
        else
          throw new EventNotFoundException();
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
