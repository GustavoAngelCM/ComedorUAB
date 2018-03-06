<?php

  session_start();
  if (isset($_SESSION['user'])) {
    if ($_SESSION['tipo'] == 2) {
      include '../controller/ctrIndex.php';
      if (isset($_GET['modo'])) {
          $menu = new ManagePage($_GET['modo']);
          $menu->menuNutricionista();
      }else {
        $menu = new ManagePage("default");
        $menu->menuNutricionista();
      }
    }else {
      header("Location: ../index.php?modo=AccesDenied");
    }  
  }else {
    header("Location: ../index.php?modo=AccesDenied");
  }

?>
