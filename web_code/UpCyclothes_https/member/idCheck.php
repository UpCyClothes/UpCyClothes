<?php
   include '../../../control/controller.php';
   $id = $_POST['id'];
   if(!ctype_alnum($id)) {
   echo "영문, 숫자만 입력가능합니다.";
   }else{
        echo idCheck($id);
   }
 ?>
