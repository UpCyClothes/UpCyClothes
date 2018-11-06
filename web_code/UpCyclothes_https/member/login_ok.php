<head>
    <meta charset="utf-8">
</head>
<?php
   include '../../../control/controller.php';

   $user_id = $_POST['userId'];
   $user_pw = $_POST['userPassword'];
   login($user_id,$user_pw);

 ?>
