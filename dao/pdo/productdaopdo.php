<?php
  namespace dao\pdo;

  use model\Product as Product;
  use dao\Connection as Connection;
  /**
   *
   */
  class ProductDaoPdo
  {

    private $connection;
    private $tableName = 'products';

    public function Add(Product $product)
    {

      try{
        $query = "INSERT INTO ".$this->tableName." (idproduct,name,description,price,image,status) VALUES(:idproduct,:code,:name,:description,:price,:image,:status)";

        $parameters["idproduct"] = $product->getProductcode();
        $parameters["name"] = $product->getrandmax();
        $parameters["description"] = $product->getDescription();
        $parameters["price"] = $product->getPrice();
        $parameters["image"] = $product->getImage();
        $parameters["status"] = "active";

        $this->connection = Connection::GetInstance();

        $this->connection = ExecuteNonQuery($query,$parameters);
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
          $query = "INSERT INTO ".TABLESIMAGE." (imgid,image,status) VALUES(:imgid,:image,:status)";

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
        $productArray = array();
        $query = "SELECT * FROM ".this->tableName." WHERE status = :status";
        $parameters["status"] = "active";
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query,$parameters);
        foreach ($result as $row) {
          // code...
            $product = new Product();
            $product->setName($row["name"]);
            $product->setDescription($row["description"]);
            $product->setPrice($row["price"]);
            $product->setProductcode($row["idproduct"]);
            $product->setImage($row["image"]);
            array_push($productArray, $event);
        }
        return $productArray;
      } catch (Exception $e) {
      }

    }

    public function GetByProductCode($idproduct)
    {
      try{
        $productR = null;
        $query = "SELECT * FROM ".this->tableName." WHERE (idproduct = :idproduct) AND (status = :status)";
        $parameters["idproduct"] = $idEvent;
        $parameters["status"] = "active";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query,$parameters);
        foreach ($resultSet as $row) {
          // code...
          $productR = new Product();
          $productR->setName($row["name"]);
          $productR->setDescription($row["description"]);
          $productR->setPrice($row["price"]);
          $productR->setProductcode($row["idproduct"]);
          $productR->setImage($row["image"]);
        }
        return $productR;
      }catch (Exception $e){

      }
    }

    public function LogicalDelete($idproduct)
    {
      try{
        $query = "UPDATE ".$this->tableName." SET Status = "inactive" WHERE idproduct = :idproduct";
        $parameters["idproduct"] = $idproduct;
        $this->connection->ExecuteNonQuery($query,$parameters);
      } catch (Exception $e){

      }
    }
  }

?>
