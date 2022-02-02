<?php
    session_start();
    require_once 'config.php';

    $bisnesesClass = new Bisness;
    $or = $_POST['or'];


    if(isset($_SESSION['user']['id'])){
        $id = $_SESSION['user']['id'];
        $paymanavorvacutyunner = $bisnesesClass->connect()->query("SELECT * FROM `calendars` where date = '$or' AND bisnes_id = '$id' ORDER BY `date` , `time`")->fetch_all(MYSQLI_ASSOC) ;
        $allusers = $bisnesesClass->connect()->query("SELECT * FROM `users`")->fetch_all(MYSQLI_ASSOC) ;
    }

    if(isset($_SESSION['user'][0])){
        $paymanavorvacutyunner = $bisnesesClass->connect()->query("SELECT * FROM `calendars` where date = '$or' ORDER BY `date` , `time`")->fetch_all(MYSQLI_ASSOC) ;
        $biznesner = $bisnesesClass->connect()->query("SELECT * FROM `bisneses`")->fetch_all(MYSQLI_ASSOC) ;
    }
   

    print(json_encode([$paymanavorvacutyunner,$biznesner,$allusers]));
    
?>