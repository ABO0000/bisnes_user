<?php
    // use Facebook\Facebook;

    require_once 'vendor/autoload.php'; 
    session_start();
    $fb = new Facebook\Facebook([
        'app_id' => '643263790210656',
        'app_secret' => '629c5d1e500049d32e1ad62a9ee1358d',
        'default_graph_version' => 'v2.10'
    ]);

    // $fb = new Facebook\Facebook([
        // 'app_id' => '320680353316094',
        // 'app_secret' => 'dac4b330b7160dd5995b093ebae29a75',
        // 'default_graph_version' => 'v2.4'
    // ]);
    $helper = $fb -> getRedirectLoginHelper();
    $login_url = $helper -> getLoginUrl('http://localhost/bisnes-user/');
    try{
        // if (isset($_SESSION['facebook_access_token'])) {
        //     $accessToken = $_SESSION['facebook_access_token'];
        // } else {
            // $accessToken = $helper->getAccessToken();
        // }
        $accessToken = $helper->getAccessToken();
        if(isset($accessToken)){
            $_SESSION['access_token'] = (string)$accessToken;
            header("Location:profile.php");
        }
        // print('ok');
    }
    catch(Exception $e){
        // echo $e ->getTraceAsString();
        echo $e;
        // header('location:index.php');
    }

    if(isset($_SESSION['access_token'])){
        try{
            $fb -> setDefaultAccessToken($_SESSION['access_token']);
            $res = $fb -> get('/me?locale=en_US&fields=name,email');
            $user = $res ->getGraphUser();
        }
        catch(Exception $e){
            echo $e ->getTraceAsString();
        }
    }
?>
