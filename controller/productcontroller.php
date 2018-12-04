<?php
  namespace controller;

  use excepcions\WrongAtributeException;
  use dao\pdo\producttDaoPdo;

  class ProductController
  {

    private $eventData;

    function __construct()
    {
      this->$eventData = new EventDaoPdo();
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
          $this->$eventData->Add(new Event($title, $description, $data, $code, $images));
        else
          throw new WrongAtributeException();
    }
  }
