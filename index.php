<?php

  include 'controller/ctrIndex.php';

  if (isset($_GET['modo'])) {
      $menu = new ManagePage($_GET['modo']);
      $menu->MenuIndex();
  }else {
    $menu = new ManagePage("default");
    $menu->MenuIndex();
  }

?>
