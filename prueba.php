<?php
include("model\\event.php");
include("controller\Eventcontroller.php");

use controller\eventcontroller;
use model\event;

  $contSpon = new EventController();
  $contSpon->Add("Un evento de mañana","Descripppccccicion","mañana");

 ?>
