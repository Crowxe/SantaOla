<?php
    namespace model;

    class Event
    {
      private $title;
      private $description;
      private $date;
      private $images = array();
      private $eventId;

      function __construct()
      {

      }

      public function getEventId()
      {
        return $this->eventId;
      }

      public function setEventId($eventId)
      {
        $this->eventId = $eventId;

        return $this;
      }


      public function getTitle()
      {
          return $this->title;
      }


      public function setTitle($title)
      {
          $this->title = $title;

          return $this;
      }


      public function getDescription()
      {
          return $this->description;
      }

      public function setDescription($description)
      {
          $this->description = $description;

          return $this;
      }

      public function getDate()
      {
          return $this->date;
      }

      public function setDate($date)
      {
          $this->date = $date;

          return $this;
      }

      public function getImages()
      {
          return $this->images;
      }

      public function setImages($images)
      {
          $this->images = $images;

          return $this;
      }

    }
  ?>
