<?php
    namespace model;

      class Product
      {

        private $name;
        private $description;
        private $price;
        private $productcode;
        private $sex;
        private $images = array();

        public function __construct()
        {

        }

    public function toString()
    {
      return $this->name." ".$this->price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

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

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getProductcode()
    {
        return $this->productcode;
    }

    public function setProductcode($productcode)
    {
        $this->productcode = $productcode;

        return $this;
    }

    public function AddImage($newImage)
    {
      array_push($this->images, $newImage);
    }
    
    public function getImages()
    {
        return $this->image;
    }

    public function setImages($images)
    {
        $this->image = $images;

        return $this;
    }

    public function getSex()
    {
        return $this->sex;
    }


    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

}




 ?>
