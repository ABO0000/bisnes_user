<?php 
session_start();
  if( isset($_SESSION['logerrors']) ){
    $errors = $_SESSION['logerrors'];
    $data = $_SESSION['data'];
  }
  
  
  // include "login.php";
  include "fbconfig.php";




?> 

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <link href="https://use/fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700$display=swap" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/mtb-ui-kit/1.0.0-alpha4/mdb.min.css" rel="stylesheet">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="shortcut icon" href="#">
      <link rel="stylesheet" type="text/css" href="stylee.css">
      <script type="text/javascript" src="js/mdb.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <title>Document</title>
  </head>
  <body style="display:flex;justify-content: center;align-items: center;" !important>
      <div id="login-box">
      <h1 style="text-align: center;margin-left:15px;margin-top:5px">Sign in</h1>
        <div class="left">
          <div class="container" style="margin-top: 40px;">
            <form class='login-email' method="post" action="config.php">
                <input type="hidden" name="login">
                <div class='input-group'>
                    <h3 class='logerror' style="color:red"><?php isset($errors['emailerror']) ? print $errors['emailerror'] : '' ; ?></h3 >
                    <input type='text' minlength="2" maxlength="25" placeholder="E-mail" name='email' value="<?php isset($data['email']) ? print $data['email'] : '' ; ?>" required>
                </div>
                <div class='input-group'>
                    <input type='password' minlength="2" maxlength="16" placeholder="Password" name='password' required>
                </div>
                <div class='input-group'>
                    <input type="submit" name="signin_submit" value="Sign in" />
                </div>
              </form>
            </div>
          </div>
          <div class="right" style="margin-top: 40px;">
            <a href="<?php echo $login_url; ?>" class="btn btn-primary btn-bacebook btn-block text-uppercase ">
              <button class="social-signin facebook">
                <i>Sign in with facebook</i>
              </button>
            </a>
            <a href="" class="btn btn-primary btn-bacebook btn-block text-uppercase ">
              <button class="social-signin twitter">
                <i>Log in with Twitter</i>
              </button>
            </a>
              <!-- <?php echo "<a href='" . $client->createAuthUrl() . "'>"?></i>
                
                <button class="social-signin google">
                  <i>Log in with Google+</i>
                </button>
              <?php "</a>"?> -->
            <p class='login-register-text'>Don't have an account<a href="register.php">Sign Up here</a></p>
        </div>
        <div class="or" style="margin-top: -35px;">OR</div>
      </div>
  </body>
</html>
