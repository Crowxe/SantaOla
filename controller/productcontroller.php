<?php
  namespace controller;

  use excepcions\WrongAtributeException;
  use dao\pdo\productDaoPdo;
  use model\Product as Product;

  class ProductController
  {

    private $productDAO;

    function __construct()
    {
      this->$productDAO = new EventDaoPdo();
    }

    public function addProduct($message = "")
    {
        try
        {
                require_once(VIEWS_PATH."add-product.php");
        }
        catch(Exception $ex)
        {
            $message = 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.\n Consulte a su Administrador o vuelva a intentarlo.';
            echo '<script type="text/javascript">confirm("'.$message.'");</script>';
            require_once(VIEWS_PATH."home.php");
        }

        }

        public function listProducts()
        {
          try
          {
        $productList = $this->productDAO->GetAll();

          require_once(VIEWS_PATH."product-list.php");
          }
          catch(Exception $ex)
        {
          $message = 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.\n Consulte a su Administrador o vuelva a intentarlo.';
          echo '<script type="text/javascript">confirm("'.$message.'");</script>';
          require_once(VIEWS_PATH."home.php");
        }
      }


      public function Add($name, $description, $price, $productcode)
      {

          //lo de la imagen lo hago después, no viene por parametro
          try
          {
              $product = new Product();
              $product->setName($name);
              $product->setDescription($description);
              $product->setPrice($price);
              $product->setProductcode($productcode);


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
