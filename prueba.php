<?php
include("model\product.php");
include("controller\productcontroller.php");

use controller\productcontroller;
use model\Product;

  $product = new Product();
  $daoProduct = new ProductController();
  $product->setName("Remera");
  $product->setDescription("una remera nike");
  $product->setPrice(400);
  $product->setSex("M");
  $product->setProductcode("AAA1");

  $daoProduct->Add($product->getName(),$product->getDescription(),$product->getPrice(),$product->getProductcode(),$product->getSex(),'dsada');

  echo $product->toString();

 ?>
