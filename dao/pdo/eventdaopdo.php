<?php
  namespace dao\pdo;

  use model\Event as Event;
  use dao\Connection as Connection;
  /**
   *
   */
  class EventDaoPdo extends AnotherClass
  {

    private $connection;
    private $tableName = 'events';

    public function Add(Event $event)
    {

      try{
        $query = "INSERT INTO ".$this->tableName." (title,description,date) VALUES(:title,:description,:date)";

        $parameters["title"] = $event->getTitle();
        $parameters["description"] = $event->getDescription();
        $parameters["date"] = $event->getDate();

        $this->connection = Connection::GetInstance();

        $this->connection = ExecuteNonQuery($query,$parameters);
      }catch(Exception $e){
        throw $e;
      }
    }

    public function GetAll()
    {
      try {
        $eventArray = array();
        $query = "SELECT * FROM ".this->tableName;
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query);
        foreach ($result as $row) {
          // code...
            $event = new Event();
            $event->setTitle($row["title"]);
            $event->setDescription($row["description"]);
            $event->setDate($row["date"]);
            array_push($eventArray, $event);
        }
        return $eventArray;
      } catch (Exception $e) {
      }

    }

    public function GetEventById($idEvent)
    {
      try{
        $eventR = null;
        $query = "SELECT * FROM ".this->tableName." WHERE idevent = :idevent";
        $parameters["idevent"] = $idEvent;
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query,$parameters);
        foreach ($resultSet as $row) {
          // code...
          $eventR->setTitle($row["title"]);
          $eventR->setDescription($row["description"]);
          $eventR->setDate($row["date"]);
        }
        return $eventR;
      }catch (Exception $e){

      }
    }

    public function LogicalDelete($idEvent)
    {
      $query = "UPDATE ".$this->tableName." SET Status = "
    }
  }

?>
