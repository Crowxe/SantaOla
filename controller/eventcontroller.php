<?php
  namespace controller;

  use excepcions\WrongAtributeException;
  use dao\pdo\EventDaoPdo;

  class Controller extends AnotherClass
  {

    private $eventData;

    function __construct()
    {
      this->$eventData = new EventDaoPdo();
    }

    function newEvent()
    {

    }

    function addEvent( $title, $description, $date, $code, $image = array() ) throws WrongAtributeException
    {
        if (($title != null && $title != "") &&
        ($description != null && $description != "") &&
        ($code != null && $code != "") &&
        ($date != null && $date != "") &&
        ($image != null && (count($image) != 0)))
        {

        }
        else
          throw new WrongAtributeException();
      }
    }
?>
