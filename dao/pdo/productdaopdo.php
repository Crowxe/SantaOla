<?php
  namespace dao\pdo;

  include("dao\Connection.php");

  use model\Product as Product;
  use dao\Connection as Connection;
  use exceptions\ProductNotFoundException as ProductNotFoundException;

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
        $query = "INSERT INTO ".$this->tableName." (idproduct,name,description,price,status,sex) VALUES(:idproduct,:name,:description,:price,:status,:sex)";

        $parameters["idproduct"] = $product->getProductcode();
        $parameters["name"] = $product->getName();
        $parameters["description"] = $product->getDescription();
        $parameters["price"] = $product->getPrice();
        $parameters["status"] = "active";
        $parameters["sex"] = $product->getSex();

        $this->connection = Connection::GetInstance();

        //$this->AddArray($product->getProductcode(),$product->getImages());
        $this->connection->ExecuteNonQuery($query,$parameters);
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
        $productArray = array();
        $query = "SELECT * FROM ".$this->tableName." WHERE status = :status";
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
            array_push($productArray, $event);
        }
        return $productArray;
      } catch (Exception $e) {
      }

    }

    public function UpdateProduct($oldId, Product $product)
    {
        try{
          $query = "UPDATE ".$this->tableName." SET idproduct = :idproduct, name = :name, description = :description, price = :price, sex = :sex WHERE idproduct = :idpre";
          $parameters["idpre"] = $oldId;
          $parameters["idproduct"] = $product->getProductcode();
          $parameters["name"] = $product->getName();
          $parameters["description"] = $product->getDescription();
          $parameters["price"] = $product->getPrice();
          $parameters["sex"] = $product->getSex();
          $this->connection = Connection::GetInstance();
          $this->connection->ExecuteNonQuery($query,$parameters);
        } catch (Exception $e){

        }
    }

    public function GetByProductCode($idproduct)
    {
      try{
        $productR = null;
        $query = "SELECT * FROM ".$this->tableName." WHERE (idproduct = :idproduct) AND (status = :status)";
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
        $query = "UPDATE ".$this->tableName." SET status = 'inactive' WHERE idproduct = :idproduct";
        $parameters["idproduct"] = $idproduct;
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query,$parameters);
      } catch (Exception $e){

      }
    }
  }

?>
