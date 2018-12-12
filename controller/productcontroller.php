<?php
  namespace controller;

  include("dao\pdo\productDaoPdo.php");

  use excepcions\WrongAtributeException;
  use dao\pdo\productDaoPdo;
  use model\Product as Product;

  class ProductController
  {
    private $productDAO;

    function __construct()
    {
      $this->productDAO = new ProductDaoPdo();
    }

      public function addProduct($message = "")
      {
          try{
                  require_once(VIEWS_PATH."add-product.php");
          } catch(Exception $ex){
              $message = 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.\n Consulte a su Administrador o vuelva a intentarlo.';
              echo '<script type="text/javascript">confirm("'.$message.'");</script>';
              require_once(VIEWS_PATH."home.php");
          }
      }

      public function listProducts($message)
      {
        try {
          $productList = $this->productDAO->GetAll();
          if ($productList == null)
            throw new ProductNotFoundException();
        //require_once(VIEWS_PATH."product-list.php");
        }catch(Exception $ex) {
          $message = 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.\n Consulte a su Administrador o vuelva a intentarlo.';
          echo '<script type="text/javascript">confirm("'.$message.'");</script>';
          require_once(VIEWS_PATH."home.php");
        }
      }

      public function UpdateProduct($oldId, $productCode, $name, $description, $price, $sex)
      {
        $product = new Product();
        $product->setProductcode($productCode);
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);
        $product->setSex($sex);
        $this->productDAO->UpdateProduct($oldId,$product);
      }

      public function Add($name, $description, $price, $productcode,$sex,$images)
      {
          //lo de la imagen lo hago después, no viene por parametro
          try
          {
              $product = new Product();
              $product->setName($name);
              $product->setDescription($description);
              $product->setPrice($price);
              $product->setProductcode($productcode);
              $product->setSex($sex);

              if($this->productDAO->GetByProductCode($product->getProductcode()) == null)
              {
                  $this->productDAO->Add($product);
                  $message = "Producto agregado con éxito";
              }
              else
                  $message = "Ya existe el producto que intenta ingresar";

              $this->listProducts($message);
          }
          catch(Exception $ex)
          {
              $message = 'Oops ! \n\n Hubo un problema al intentar agregar el producto.\n Consulte a su Administrador o vuelva a intentarlo.';
              echo '<script type="text/javascript">confirm("'.$message.'");</script>';
              require_once(VIEWS_PATH."home.php");
          }
      }

      public function moveImage($name)
      {
            $imageDirectory = CSS_PATH.'img/products/';

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

      public function Delete($productCode)
      {
            try
            {
                $this->productDAO->LogicalDelete($productCode);

                $this->listProducts();
            }
            catch(Exception $ex)
            {
                $message = 'Oops ! \n\n Hubo un problema al intentar eliminar el producto.\n Consulte a su Administrador o vuelva a intentarlo.';
                echo '<script type="text/javascript">confirm("'.$message.'");</script>';
                require_once(VIEWS_PATH."home.php");
              }
      }

      public function GetAll()
      {
        $products = $this->productDAO->GetAll();
        if ($products != null)
          return $products;
        else
          throw new ProductNotFoundException();
      }

      public function GetProduct($code)
      {
        $product = $this->productDAO->GetProductByCode($code);
        if ($product != null)
          return $product;
        else
          throw new ProductNotFoundException();
      }

      public function GetProductsByFilters($filters = array())
      {
        $products = $this->productDAO->GetProductsByFilters($filters);
        if ($products != null)
          return $products;
        else
          throw new ProductNotFoundException();
      }

      public function ShowException()
      {
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
