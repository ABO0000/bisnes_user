<?php
  require_once 'vendor/autoload.php'; 
  include "./config.php";
  
  $bisnessClass = new Bisness;
  
  $clientID='167734828725-897ktkprokdgq1ml9n88hqle3pijr2ie.apps.googleusercontent.com';
  $clientSecret='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';
  $redirectUrl='http://localhost/bisnes-user/';
  
  $client = new Google_Client();
  $client -> setClientId($clientID);
  $client -> setClientSecret($clientSecret);
  $client -> setRedirectUri($redirectUrl);
  $client -> addScope('profile');
  $client -> addScope('email');
  
  if(isset($_GET['code'])){
    $token = $client -> fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    
    $gauth = new Google_Service_Oauth2($client);
    $google_info = $gauth ->userinfo ->get();
    $email = $google_info -> email;
    $fullname = $google_info -> name;
    $myJSON = explode(' ', $fullname);
    $name = $myJSON[0];
    $surname = $myJSON[1];
    $useron = $bisnessClass->connect()->query("SELECT * FROM `users` WHERE email = '$email' ")->fetch_all(MYSQLI_ASSOC) ;

    
    if($useron){
      // print_r($useron);
      $_SESSION['user'] = $useron;

    }else{
      $bisnessClass->connect()->query("INSERT INTO users (name,surname,email, password) VALUES ('$name', '$surname','$email','$password')");
      $useron = $bisnessClass->connect()->query("SELECT * FROM `users` WHERE email = '$email' ")->fetch_all(MYSQLI_ASSOC) ;
      $_SESSION['user'] = $useron;
      // print_r($useron);
    }

      header("Location:profile.php");
    // echo "Welcome" .$name ;

  }else{
    // header("Location:index.php");
    // echo "<a href='" . $client->createAuthUrl() . "'>Login with Google</a>";
  }
  ?>