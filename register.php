<?php
  session_start();
  if( isset($_SESSION['regerrors']) ){
    $errors = $_SESSION['regerrors'];
    $data = $_SESSION['data'];
  }
  session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="stylee.css">
    <title>Document</title>
  </head>
  <body style="display:flex;justify-content: center;align-items: center; " !important>
    <div id="login-box">
      <h1 style="text-align: center;margin-left:25px;margin-top:5px">Sign up</h1>
    <div  style="margin-top: 17px;" >
      
    <form class='login-email' method="post" action="config.php" style="text-align:center ;margin-left:35%">
        <input type="hidden" name="register">
      <div class='input-group'>
        <label for="name" style="color:red;font-size:12px;display:flex;justify-contant:center"><?php isset($errors['nameerror']) ? print $errors['nameerror'] : '' ; ?></label>
        <input style="margin-bottom: 5px;" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==10)" minlength="2" maxlength="16" id='naem' placeholder="User Name" name='name'  value="<?php isset($data['name']) ? print $data['name'] : '' ; ?>">
      </div>
      <div class='input-group'>
        <label for="surname" style="color:red;font-size:12px;display:flex;justify-contant:center"><?php isset($errors['surnameerror']) ? print $errors['surnameerror'] : '' ; ?></label>
        <input style="margin-bottom: 5px;" type='text' onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==10)" minlength="2" maxlength="16" placeholder="User Surname" name='surname' value="<?php isset($data['surname']) ? print $data['surname'] : '' ; ?>">
      </div>
      <div class='input-group'>
        <label for="email" style="color:red ;font-size:12px;display:flex;justify-contant:center"><?php isset($errors['emailerror']) ? print $errors['emailerror'] : '' ; ?></label>
        <input style="margin-bottom: 5px;" type='text' minlength="2" maxlength="23" placeholder="E-mail" name='email' value="<?php isset($data['email']) ? print $data['email'] : ''?>">
      </div>
      <div class='input-group'>
        <label for="password" style="color:red; font-size:12px;display:flex;justify-contant:center"><?php isset($errors['passworderror']) ? print $errors['passworderror'] : '' ; ?></label>
        <input style="margin-bottom: 5px;" type='password' minlength="2" maxlength="16" placeholder="Password" name='password'>
      </div>
      <div class='input-group'>
        <input style="margin-bottom: 5px;" type='password' minlength="2" maxlength="16" placeholder="Confirm Password" name='cpassword'>
      </div>
      <div class='input-group' style="width: 220px;">
        <input  type="submit" name="signup_submit" value="Sign me up" style="margin-top: 5px;"/>
        <p class='login-register-text'>Have an account<a href="index.php">Login here</a></p>
      </div>
    </form>
  </body>
</html>