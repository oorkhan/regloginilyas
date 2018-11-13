<?php
  class Xett{
    private $bashlangic,$son;

    public function setBaslangic($b){
      $this->bashlangic = $b;
    }

    public function getBaslangic(){
      return $this->bashlangic;
    }

    public function setSon($s){
      $this->son = $s;
    }

    public function getSon(){
      return $this->son;
    }

    public function uzunluq(){
      return (($this->getBaslangic()->getX() - $this->getSon()->getX())**2 + ($this->getBaslangic()->getY() - $this->getSon()->getY())**2)**(1/2);
    }
  }
 ?>
