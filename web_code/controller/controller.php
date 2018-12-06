<?php

function dbconnectTesting(){
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"dokyeong");
    $mysqli->set_charset('utf8');
    $id = 'dkdk6638';
    if($mysqli){
      $result = mysqli_query($mysqli,$sql);
        if(mysqli_num_rows($result)==0){
          return 'count : 0';
        }else{
        return mysqli_num_rows($result)+"";
        }
    }
    else{
        return 'disconnect : 실패';
    }
  }

function Encrypt($str, $secret_key='secret key', $secret_iv='secret iv')
  {
      //echo "in the encrypt fn";
      $key = hash('sha256', $secret_key);
      $iv = substr(hash('sha256', $secret_iv), 0, 32);

      return str_replace("=", "", base64_encode(
                   openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
      );
  }

  //복호화
  function Decrypt($str, $secret_key='secret key', $secret_iv='secret iv')
  {
      $key = hash('sha256', $secret_key);
      $iv = substr(hash('sha256', $secret_iv), 0, 32);

      return openssl_decrypt(
              base64_decode($str), "AES-256-CBC", $key, 0, $iv);
  }

  function idCheck($id){// id 중복체크 function
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    if($mysqli){
        $sql = "SELECT userID from user WHERE userID = '".$id."'";
        $result = mysqli_query($mysqli,$sql);
        if(mysqli_num_rows($result)==0){
          return 1;
        }else{
          return 0;
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
  }

  function nickNameCheck($nickname){
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    if($mysqli){
        $sql = "SELECT nickname from user WHERE nickname = '".$nickname."'";
        $result = mysqli_query($mysqli,$sql);
        if(mysqli_num_rows($result)==0){
          return 1;
        }else{
          return 0;
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
  }

function register($id,$password,$name,$userType,$nickname,$address1,$address2,$zipcode,$tel,$email,$reception, $tag1, $tag2){

    $secret_key="123456789";
    $secret_iv="#$%^*()";

    $encrypted_pw=Encrypt($password,$secret_key,$secret_iv);

    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');

    if($mysqli){
      $sql = "INSERT INTO user (userID,userPW ,userName, userType, nickname, address1, address2, zipcode, tel, Email, reception, tag1, tag2)";
      $sql = $sql." VALUES ('$id','$encrypted_pw','$name','$userType','$nickname','$address1','$address2','$zipcode','$tel','$email','$reception','$tag1','$tag2')";
      $result = mysqli_query($mysqli,$sql);

      if($result){
           //회원가입 성공!
           echo("<script>alert('Upcyclothes에 가입해주셔서 감사합니다.');</script>");
            echo("<script>location.replace('../member/login.php');</script>");
        }else{
          //회원가입 실패!
          	echo("<script>alert('회원가입에 실패하였습니다. 다시 시도해주세요.');</script>");
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
  }

//$password,$type,$nickname,$address1,$address2,$zipCode,$tel,$email,$reception,$tag1,$tag2
function modifyUser($name,$zipCode,$address1,$address2,$tel,$email,$reception,$tag1,$tag2){
  session_start();
    if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
          $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
          $mysqli->set_charset('utf8');
              if($mysqli){

                $updateSQL = "UPDATE user SET userName ='".$name."'";
                $updateSQL = $updateSQL.", address1 ='".$address1."'";
                $updateSQL = $updateSQL.", address2 ='".$address2."'";
                $updateSQL = $updateSQL.", zipcode ='".$zipCode."'";
                $updateSQL = $updateSQL.", tel ='".$tel."'";
                $updateSQL = $updateSQL.", Email ='".$email."'";
                $updateSQL = $updateSQL.", reception=".$reception;
                $updateSQL = $updateSQL.", tag1 =".$tag1.", tag2 =".$tag2;
                $updateSQL = $updateSQL." WHERE userID ='".$user_id."'";
                $result = mysqli_query($mysqli,$updateSQL);
                if($result){
                  echo("<script>alert('정보가 정상적으로 변경되었습니다.');</script>");
                  echo("<script>location.replace('../index.php');</script>");
               }else{
                 echo("<script>alert('다시 시도해주세요.');
                   history.back();</script>");
               }
             }else{
                  return 'sorry. DataBase is not connection.';
              }
    }
  }

function modifyOK($new1){
  $secret_key="123456789";
  $secret_iv="#$%^*()";

  $encrypted_pw=Encrypt($new1,$secret_key,$secret_iv);
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');

  session_start();
  if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
  }
  if($mysqli){
  //  $sql = "INSERT INTO user (userID,userPW ,userName, userType, nickname, address1, address2, zipcode, tel, Email, reception, tag1, tag2)";
    $updateSQL = "UPDATE user SET userPW ='".$encrypted_pw."'";
    $updateSQL = $updateSQL." WHERE userID ='".$user_id."'";
    $result = mysqli_query($mysqli,$updateSQL);

    if($result){
         //비밀번호 변경 성공!
         echo '<script type="text/javascript">
          alert("비밀번호가 변경되었습니다. 다시 로그인하세요.");
          </script>';
         session_destroy();
        echo("<script>location.replace('../index.php');</script>");
      }else{
        //회원가입 실패!
          echo("<script>alert('정보변경에 실패하였습니다. 다시 시도해주세요.');</script>");
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
}

function checkLogin(){
      session_start();
      if(isset($_SESSION['userId']) && isset($_SESSION['userPassword'])){
          //로그인 하면 트루
          return true;
      }else{
          //로그인 안했으면 false
          return false;
      }
}

function checkType(){
    session_start();
    if(isset($_SESSION['userId']) && isset($_SESSION['userPassword'])){

      $user_id = $_SESSION['userId'];
      $user_pw = $_SESSION['userPassword'];

      $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
      $mysqli->set_charset('utf8');

      if($mysqli){
      $sql = "SELECT usertype FROM user WHERE userID ='".$user_id."' and userPW = '".$user_pw."'";

      $result = mysqli_query($mysqli,$sql);
      $row = mysqli_fetch_array($result);

      if($row[0]==0){
             // 디자이너 로그인 상황
              return true;
          }else{
            // 소비자 로그인 상황
              return false;
          }
      }else{
              return false;
      }
    }else{
      return false;
    }
  }

function checkID(){
    session_start();
    if(isset($_SESSION['userId']) && isset($_SESSION['userPassword'])){
      $user_id = $_SESSION['userId'];
      return $user_id;
    }else{
      return false;
    }
}

function logIn($id,$pw){
      //echo "string";
      session_start();

      $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
      $mysqli->set_charset('utf8');

      $user_id = $id;
      $user_pw = $pw;

      $secret_key="123456789";
      $secret_iv="#$%^*()";

      $encrypted_pw=Encrypt($user_pw,$secret_key,$secret_iv);

      $sql = "SELECT * FROM user WHERE userID ='".$user_id."' and userPW = '".$encrypted_pw."'";


      $result = $mysqli->query($sql);

      if(mysqli_num_rows($result)!=0){
          //세션에 정보 저장
          $_SESSION['userId'] = $user_id;
          $_SESSION['userPassword'] = $encrypted_pw;
          Header("Location:../index.php");

      }else{
        echo '<script type="text/javascript">
              alert("등록되지 않은 아이디거나 잘못된 패스워드를 입력하셨습니다.");
              </script>';
        echo("<script>location.replace('../member/login.php');</script>");
      }
}

function checkAdmin(){
  session_start();
  if(isset($_SESSION['userId']) && isset($_SESSION['userPassword'])){
    //로그인 되어있는 상황?
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');

    $user_id = $_SESSION['userId'];
    $sql = "SELECT * FROM user WHERE userID ='".$user_id."'";
    $sql = $sql."and usertype= 3";
    $result = $mysqli->query($sql);
    if($mysqli){
      if(mysqli_num_rows($result)!=0){

        return true;
      }else{

        session_destroy();
        return false;
      }
    }
  }else{
      //로그인 안했으면 false

      return false;
  }
}

function adminlogin($id,$pw){
  session_start();

  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');

  $user_id = $id;
  $user_pw = $pw;

  $secret_key="123456789";
  $secret_iv="#$%^*()";

  $encrypted_pw=Encrypt($user_pw,$secret_key,$secret_iv);

  $sql = "SELECT * FROM user WHERE userID ='".$user_id."' and userPW = '".$encrypted_pw."'";
  $sql = $sql."and usertype= 3";
  $result = $mysqli->query($sql);

  if($mysqli){
    if(mysqli_num_rows($result)!=0){
    $_SESSION['userId'] = $user_id;
    $_SESSION['userPassword'] = $encrypted_pw;
    echo '<script type="text/javascript">
         alert("로그인 성공.");
         </script>';
    Header("Location:../admin/admin.php");
  }else{
      echo '<script type="text/javascript">
            alert("관리자로 등록되지 않은 아이디거나 잘못된 패스워드를 입력하셨습니다.");
            history.back();
            </script>';
  }
  }else{
      return 'sorry. DataBase is not connection.';
  }
}

function getUserName(){
  session_start();
  if(isset($_SESSION['userId']) && isset($_SESSION['userPassword'])){
      //DB에서 이름 찾아서 넣어주기
      $user_id = $_SESSION['userId'];
      $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
      $mysqli->set_charset('utf8');
      if($mysqli){
        $getIDSQL = "SELECT userName FROM user WHERE userID ='".$user_id."'";
        //echo $updateSQL;
       $result = mysqli_query($mysqli,$getIDSQL);
        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_array($result);
            return $row[0];
          }else{
            return "ID-ERROR";
          }
      }else{
          return 'sorry. DataBase is not connection.';
      }
  }else{
      //로그인 안했으면 false
      return "ERROR";
  }
}

function getUserAddress1(){
  session_start();
  if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
  }

  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
  }else{
        $row = mysqli_fetch_array($result);
       return $row[6];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getUserAddress2(){
  session_start();
  if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
  }
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
  }else{
        $row = mysqli_fetch_array($result);
       return $row[7];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getUserZipcode(){
  session_start();
  if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
  }
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
  }else{
        $row = mysqli_fetch_array($result);
       return $row[8];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getUserPhone(){
  session_start();
  if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
  }
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
      }else{
        $row = mysqli_fetch_array($result);
       return $row[9];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getUserEmail(){
  session_start();
  if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
  }
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
      }else{
        $row = mysqli_fetch_array($result);
       return $row[10];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getUserReception(){
  session_start();
  if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
  }
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
      }else{
        $row = mysqli_fetch_array($result);
       return $row[11];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getUserNickname(){
  session_start();
  if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
  }
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
      }else{
        $row = mysqli_fetch_array($result);
       return $row[4];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function modifyPassword($pw){

  session_start();

  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');

  session_start();
  if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
  }

  $user_pw = $pw;

  $secret_key="123456789";
  $secret_iv="#$%^*()";

  $encrypted_pw=Encrypt($user_pw,$secret_key,$secret_iv);

  $sql = "SELECT * FROM user WHERE userID ='".$user_id."' and userPW = '".$encrypted_pw."'";


  $result = $mysqli->query($sql);

  if(mysqli_num_rows($result)!=0){
      //세션에 정보 저장

      return 0;

  }else{
      return 1;
  }
}

function designerLeave($id){
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');

    if($mysqli){
      $user_nickname = getUserNickname();

      //1. Product에 있는 $id와 같은 값 모두 삭제 : NickName으로 반드시!

      $ProductDelete = "DELETE from Product WHERE designer = '".$user_nickname."'";
      $result = mysqli_query($mysqli,$ProductDelete);

      //2. Messenger에 있는 $id와 같은 값 모두 삭제
      // DesignerID = nickname, userID = id

      $MessegeDelete1 = "DELETE from messenger WHERE designerID = '".$user_nickname."'";
      $result = mysqli_query($mysqli,$MessegeDelete1);

      $MessegeDelete2 = "DELETE from messenger WHERE userID = '".$id."'";
      $result = mysqli_query($mysqli,$MessegeDelete2);

      //3. Review에 있는 $id와 같은 값 모두 삭제

      $reviewDelete = "DELETE from Review WHERE userID = '".$id."'";
      $result = mysqli_query($mysqli,$reviewDelete);

      //4. MyCart 있는 userID =$id와 같은 값 모두 삭제
      $orderDelete = "DELETE from orderList WHERE userID = '".$id."'";
      $result = mysqli_query($mysqli,$orderDelete);

      //4. MyCart 있는 userID =$id와 같은 값 모두 삭제
      $cartDelete = "DELETE from Mycart WHERE user_ID = '".$id."'";
      $result = mysqli_query($mysqli,$cartDelete);

      //tempDB 내용 삭제 .

      $tempDelete = "DELETE from tempDB WHERE designer = '".$user_nickname."'";
      $result = mysqli_query($mysqli,$tempDelete);

      //4. 회원 탈퇴

      $userDelete = "DELETE from user WHERE userID = '".$id."'";
      $result = mysqli_query($mysqli,$userDelete);

    }else{
        return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);

    //5. 로그아웃
    session_start();
    session_destroy();
}

function consumerLeave($id){

  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');

  if($mysqli){
    $user_nickname = getUserNickname();

  //1. Messenger에 있는 userID = $id 모두 삭제

    $MessegeDelete2 = "DELETE from messenger WHERE userID = '".$id."'";
    $result = mysqli_query($mysqli,$MessegeDelete2);

  //2. Review에 있는 userID = $id와 같은 값 모두 삭제

    $reviewDelete = "DELETE from Review WHERE userID = '".$id."'";
    $result = mysqli_query($mysqli,$reviewDelete);

    //3. OrderList에 있는 userID =$id와 같은 값 모두 삭제
    $orderDelete = "DELETE from orderList WHERE userID = '".$id."'";
    $result = mysqli_query($mysqli,$orderDelete);

    //4. MyCart 있는 userID =$id와 같은 값 모두 삭제
    $cartDelete = "DELETE from Mycart WHERE user_ID = '".$id."'";
    $result = mysqli_query($mysqli,$cartDelete);


    //6. 회원 탈퇴 userID = id

    $userDelete = "DELETE from user WHERE userID = '".$id."'";
    $result = mysqli_query($mysqli,$userDelete);

  }else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);





  //4. 로그아웃
  session_start();
  session_destroy();
}

?>
