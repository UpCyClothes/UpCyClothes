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
          return '사용 가능한 ID입니다.';
        }else{
          return '중복되는 ID입니다. 다른 ID로 가입하세요.';
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
          return '사용 가능한 닉네임입니다.';
        }else{
          return '중복되는 닉네임입니다. 다른 닉네임으로 가입하세요.';
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
            echo("<script>location.replace('../index.php');</script>");
        }else{
          //회원가입 실패!
          	echo("회원가입에 실패하였습니다. 다시 시도해주세요!");
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
          echo '<script type="text/javascript">
                alert("로그인 성공.");
                </script>';
          Header("Location:../index.php");

      }else{
        echo '<script type="text/javascript">
              alert("등록되지 않은 아이디거나 잘못된 패스워드를 입력하셨습니다.");
              history.back();
              </script>';
      }
  }



?>
