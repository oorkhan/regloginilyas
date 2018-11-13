<?php
  require("Xett.php");
  require("Noqte.php");

  $noqte1 = new Noqte(0,0);
  $noqte2 = new Noqte(2,3);


  $xett1 = new Xett();
  $xett1->setBaslangic($noqte1);
  $xett1->setSon($noqte2);

  echo $xett1->uzunluq();
  var_dump($xett1);


  $noqte3 = new Noqte(2,2);

  echo $noqte2->mesafe($noqte3);

 ?>
