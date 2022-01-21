<?php
//   require_once 'config,php';

//   if(isset($accessToken))
//   {
//     if(!isset($_SESSION['facebook_access_token'])){
//       $_SESSION['facebook_access_token'] = (string) $accessToken;
//       $oAuth2Client = $fb -> getOauth2Client();
//       $longLivedAccessToken = $oAuth2Client ->getLongLivedAccessToken($_SESSION['facebook_access_token']);
//       $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
//       $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
//     }
//     else{
//       $fb -> setDefaultAccessToken($_SESSION['facebook_access_token']);
//     }

//     try{
//       $fb_response = $fb -> get('/me?friends = name,first_name,last_name,email');
//       $fb_response_picture = $ffb -> get('/me/picture?redirect=false&height=200');

//       $fb_user = $fb_response->getGraphUser();
//       $fb_picture = $fb_response_picture->getGraphUser();

//       $_SESSION['fb_user_id'] = $fb_user -> getProperty('id');
//       $_SESSION['fb_user_name'] = $fb_user -> getProperty('name');
//       $_SESSION['fb_user_email'] = $fb_user -> getProperty('email');
//       $_SESSION['fb_user_pic'] = $picture['url'];
//     } 
//     catch(Facebook\Exceptions\FacebookResponseException $e){
//       echo 'Facebook API Error: ' . $e ->getMessage();
//       session_destroy();

//       header("Location: ./");
//       exit;
//     }
//     catch(Facebook\Exceptions\FacebookSDKException $e){
//       echo 'Facebook SDK Error: ' . $e ->getMessage();
//       exit;
//     }
//   }
//   else
//   {
//     $fb_login_url = $fb_helper -> getLoginUrl(FB_BASE_URL);
//   }
  ?>





<?php
  if(isset($login_url)){
    include "form.php";
  }else{
     echo '<div class="card card-signin my-5"><div class="card-body">';
     echo '<h4>Welcome User</h4>';
     echo '<h3><img src=' .$_SESSION['user_pic'].'width="150"/></h3>';
     echo '<h3><b>Name:</b>:' .$_SESSION['user_name'].'</h3>';
     echo '<h3><b>Email Address:</b>:' .$_SESSION['user_email_address'].'</h3>';
     echo '<h3><a href="logout.php">Logout</a></h3>';
     echo '</div> </div>';
  }
?>



<?php if(isset($_SESSION['access_token'])){?>
      <div class="container mt-4">
        <?php echo "Hello " . $user->getField('name') ?>
        <a href="logout.php">Logout</a>
      </div>
    <?php }else{?> 
      <?php }?>