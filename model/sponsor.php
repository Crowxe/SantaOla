<?php
      namespace model;

      class Sponsor
      {
        private $name;
        private $description;
        private $dni;
        private $images = array();

        public function toString()
        {
          return "Name: ".$this->name."<br>Descripcion: ".$this->description."<br>DNI: ".$this->dni."<br>";
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

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    public function getImages()
    {
        return $this->images;
    }


    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

}




  ?>
