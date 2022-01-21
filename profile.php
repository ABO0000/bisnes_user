<?php 
    session_start();
    require_once 'fbconfig.php';
    require_once 'login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ok</h1>
    <?php if(isset($_SESSION['access_token'])){?>
        <div class="container mt-4">
            <?php echo "Hello " . $user->getField('name') ?>
            <a href="logout.php">Logout</a>
        </div>
    <?php }?>
    <?php if(isset($_SESSION['name'])){?>
        <div class="container mt-4">
            <?php echo "barev " . $_SESSION['name'] ?>
            <a href="logout.php">Logout</a>
        </div>
    <?php }?>
    
</body>
 </html>

      

