<?php
include("model\product.php");
include("controller\productcontroller.php");

use controller\productcontroller;
use model\Product;

  $product = new Product();
  $contProduct = new ProductController();
  $product->setName("Remera");
  $product->setDescription("una remera nike");
  $product->setPrice(400);
  $product->setSex("M");
  $product->setProductcode("AAA1");

  $contProduct->Delete($product->getProductcode());

  echo $product->toString();

 ?>
