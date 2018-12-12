<?php
  namespace dao\pdo;
  include("dao\Connection.php");

  use model\Event as Event;
  use dao\Connection as Connection;
  use exceptions\EventNotFoundException as EventNotFoundException;
  /**
   *
   */
  class EventDaoPdo
  {

    private $connection;
    private $tableName = 'events';

    public function Add(Event $event)
    {

      try{
        $query = "INSERT INTO ".$this->tableName." (title,description,date,status) VALUES(:title,:description,:date,:status)";
        $parameters["title"] = $event->getTitle();
        $parameters["description"] = $event->getDescription();
        $parameters["date"] = $event->getDate();
        $parameters["status"] = "active";

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query,$parameters);

    //    $query2 = $this->GetIdEvent($event->getTitle(), $event->getDescription());
    //    $parameters2["title"] = $event->getTitle();
    //    $parameters2["description"] = $event->getDescription();
    //    $idevent = $this->connection->Execute($query2,$parameters2);
    //    $this->AddArray($idevent, $event->getImages());

      }catch(Exception $e){
        throw $e;
      }
    }

    public function AddArray($idarray, $array = array())
    {
      $i = 0;
      foreach ($array as $link) {
        // code...
        try{
          $query = "INSERT INTO ".IMAGESTABLE." (imgid,image,status) VALUES(:imgid,:image,:status)";

          $parameters["imgid"] = $idarray;
          $parameters["image"] = $link;
          $parameters["status"] = "active";

          $this->connection = ExecuteNonQuery($query,$parameters);
        }catch(Exception $e){
          throw $e;
        }
      }
    }

    public function GetAll()
    {
      try {
        $eventArray = array();
        $query = "SELECT * FROM ".$this->tableName." WHERE status = :status";
        $parameters["status"] = "active";
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query,$parameters);
        foreach ($result as $row) {
          // code...
            $event = new Event();
            $event->setTitle($row["title"]);
            $event->setDescription($row["description"]);
            $event->setDate($row["date"]);
            array_push($eventArray, $event);
        }
        if ($eventArray != null)
          return $eventArray;
        else
          throw new EventNotFoundException();
      } catch (Exception $e) {
      }

    }

    public function GetIdEvent($title, $description)
    {
      try{

        $query = "SELECT idevent FROM ".$this->tableName." WHERE (title = :title) AND (description = :description)";
        $parameters["title"] = $title;
        $parameters["description"] = $description;
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query, $parameters);
        foreach ($resultSet as $row) {
          // code...
          $idevent = $row["idevent"];
        }
        return $idevent;
      }catch (Exception $e){

      }
    }

    public function GetEventById($idEvent)
    {
      try{
        $eventR = null;
        $query = "SELECT * FROM ".$this->tableName." WHERE (idevent = :idevent) AND (status = :status)";
        $parameters["idevent"] = $idEvent;
        $parameters["status"] = "active";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query,$parameters);
        foreach ($resultSet as $row) {
          // code...
          $eventR = new Event();
          $eventR->setTitle($row["title"]);
          $eventR->setDescription($row["description"]);
          $eventR->setDate($row["date"]);
        }
        return $eventR;
      }catch (Exception $e){

      }
    }

    public function UpdateEvent(Event $event)
    {
      try{
        $idEvent = $this->GetIdEvent($event->getTitle(),$event->getDescription())
        $query = "UPDATE ".$this->tableName." SET title = :title, description = :description, date = :date WHERE idevent = :idevent";
        $parameters["title"] = $event->getTitle();
        $parameters["description"] = $event->getDescription();
        $parameters["date"] =$event->getDate();
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query,$parameters);
      } catch (Exception $e){

      }
    }

    public function LogicalDelete($idEvent)
    {
      try{
        $query = "UPDATE ".$this->tableName." SET Status = 'inactive' WHERE idevent = :idevent";
        $parameters["idevent"] = $idevent;
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query,$parameters);
      } catch (Exception $e){

      }
    }
  }

?>
