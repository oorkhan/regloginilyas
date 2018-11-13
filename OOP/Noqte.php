<?php

  class Noqte{
    private $x,$y;


    public function __construct($x,$y){
      $this->x = $x;
      $this->y = $y;
    }

    public function setX($x){
      $this->x = $x;
    }

    public function setY($y){
      $this->y = $y;
    }

    public function getX(){
      return $this->x;
    }

    public function getY(){
      return $this->y;
    }

    public function mesafe($bashqa_noqte){
      return (($this->getX() - $bashqa_noqte->getX())**2 + ($this->getY() - $bashqa_noqte->getY())**2)**(1/2);
    }
  }



 ?>
