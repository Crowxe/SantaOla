<?php
  namespace controller;

  use excepcions\WrongAtributeException;
  use dao\pdo\EventDaoPdo;

  class EventController
  {

    private $eventDAO;

    function __construct()
    {
      this->$eventDAO = new EventDaoPdo();
    }

    function newEvent()
    {

    }

    function addEvent( $title, $description, $date, $code, $images = array() ) throws WrongAtributeException
    {
        if (($title != null && $title != "") &&
        ($description != null && $description != "") &&
        ($code != null && $code != "") &&
        ($date != null && $date != "") &&
        ($image != null && (count($image) != 0)))
          $this->$eventDAO->Add(new Event($title, $description, $data, $code, $images));
        else
          throw new WrongAtributeException();
    }
  }
?>
