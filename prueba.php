<?php
  use model\product as Product;

  $product = new Product();
  $product->setName("Remera");
  $product->setDescription("una remera nike");
  $product->setPrice(400);
  $product->setSex("M");
  $product->setProductcode("AAA1");


  echo $product;

 ?>
