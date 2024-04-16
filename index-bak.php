<?php

  //include("bcms/classes/clsClassFactory.php");
  //echo "I Am Legendary 001";
  //include("bcms/classes/clsSystem.php");
  //echo "I Am Legendary 002";
  $s=new clsSystem();
  clsClassFactory::Set_Class_Variable("sh",$clsSession);
  //print_r(clsClassFactory::$all_vars['sh'].' \n');
  //print_r($_SESSION);