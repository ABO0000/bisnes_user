<?php

use phpseclib3\Common\Functions\Strings;

class Bisness
    {
        private $db;
        function __construct()
        {
            session_start();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["login"])) {
                    $this->Login();
                }
                if (isset($_POST["register"])) {
                    $this->Register();
                }
                if (isset($_POST["bisnes"])) {
                    $this->Bisnes();
                }
                if (isset($_POST["addDate"])) {
                    $this->AddDate();
                }
                if(isset($_POST["delete_id"])){
                    $this->DeleteMeeting();
                }
                if(isset($_POST["update_id"])){
                    $this->UpdateMeeting();
                }
            }
        }

        public function connect()
        {
            $this->db = new mysqli("127.0.0.1","admin","password","bisnes_user");
            return $this->db;
        }

        public function Login()
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = [];
            if (empty($email)) {
                $errors['emailerror'] = 'email field is required';
            } else {
                $user = $this->connect()->query("select * from users where email = '$email' ")->fetch_assoc();

                if(!$user){
                    $user = $this->connect()->query("select * from bisneses where email = '$email' ")->fetch_assoc();
                }

                if ($user === NULL) {
                    $errors['emailerror'] = "don't registering";
                } else if ($user['password'] !== $password) {
                    $errors['emailerror'] = "wrong password";
                }
            }
            if (count($errors)) {
                $_SESSION['logerrors'] = $errors;
                $_SESSION['data'] = $_POST;
                header("Location:index.php");
            } else {
                $_SESSION['user'] = $user;
                header("Location:profile.php");
            }
        }

        public function Register()
        {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $errors = [];
            if (empty($name)) {
                $errors['nameerror'] = 'Name field is required';
            }
            if (empty($surname)) {
                $errors['surnameerror'] = 'Surname field is required';
            }
            
            if (empty($email)) {
                $errors['emailerror'] = 'email field is required';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['emailerror'] = 'email address must be valid';
            } else {
                $user = $this->connect()->query("select * from users where email = '$email' ");
                if ($user->fetch_assoc() !== NULL) {
                    $errors['emailerror'] = 'email address already exists';
                }
            }

            if (empty($password)) {
                $errors['passworderror'] = 'password field is required';
            } else if (strlen($password) < 8) {
                $errors['passworderror'] = "password's must be equal or more than 8";
            }
            if ($password != $cpassword) {
                $errors['passworderror'] = 'password and confirm password must be equal';
            }

            if (count($errors)) {
                $_SESSION['regerrors'] = $errors;
                $_SESSION['data'] = $_POST;
                header("Location:register.php");
            } else {
                $this->connect()->query("INSERT INTO users (name,surname,email, password) VALUES ('$name', '$surname','$email','$password')");
                header("Location:index.php");
            }
            // $d = $this->connect()->query
        }
        // print $d + 5;
        // print_r( mysqli_error($d) );
        // header("Location:profile.php");
        // print "<pre>";
        // print_r($errors);

        public function Bisnes()
        {
            $name = $_POST['name'];
            $categoria = $_POST['categoria'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $errors = [];
            if (empty($name)) {
                $errors['nameerror'] = 'Name field is required';
            }
            if (empty($categoria)) {
                $errors['categoriaerror'] = 'Categoria field is required';
            }
            
            if (empty($email)) {
                $errors['emailerror'] = 'email field is required';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['emailerror'] = 'email address must be valid';
            } else {
                $user = $this->connect()->query("select * from users where email = '$email' ");
                if ($user->fetch_assoc() !== NULL) {
                    $errors['emailerror'] = 'email address already exists';
                }
            }

            if (empty($password)) {
                $errors['passworderror'] = 'password field is required';
            } else if (strlen($password) < 8) {
                $errors['passworderror'] = "password's must be equal or more than 8";
            }
            if ($password != $cpassword) {
                $errors['passworderror'] = 'password and confirm password must be equal';
            }

            if (count($errors)) {
                $_SESSION['regerrors'] = $errors;
                $_SESSION['data'] = $_POST;
                header("Location:startbisnes.php");
            } else {
                $this->connect()->query("INSERT INTO bisneses (name,categoria,email, password) VALUES ('$name', '$categoria','$email','$password')");
                header("Location:index.php");
            }
            // $d = $this->connect()->query
        }

        public function AddDate()
        {
            $data = $_POST['addDate'];
            $user_id = $_POST['user_id'];
            $bisnes_id = $_POST['bisnes_id'];
            $day=implode(' ',explode(' ',$data,-1));
            $myJSON = explode(' ', $data,4);
            $time = $myJSON[3];
                // print($user_id);
                // print_r($time);
            $errors = [];
            
            
            
            if (empty($_SESSION['user'])) {
                header("Location:index.php");
                // $errors['usererror'] = 'user field is required';

                // print_r('login');
            } 
            // else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // $errors['emailerror'] = 'email address must be valid';
            // }
             else {
                $date = $this->connect()->query("select * from calendars where bisnes_id = '$bisnes_id' AND date = '$day' AND time = '$time' ");
                if ($date->fetch_assoc() !== NULL) {
                    $errors['dateerror'] = 'That hour is already busy';
                }
            }

            if (empty($data)) {
                $errors['dataerror'] = 'Date field is required';
            }
            
            if (count($errors)) {
                $_SESSION['adddateerrors'] = $errors;
                $_SESSION['data'] = $_POST;
                print_r($errors);
                // header("Location:profile.php");
            } else {
                $this->connect()->query("INSERT INTO calendars (user_id,bisnes_id,date,time) VALUES ( '$user_id','$bisnes_id','$day','$time')");
                // print_r('ok');
                header("Location:profile.php");
            }
            // $d = $this->connect()->query
        }

        public function DeleteMeeting()
        {
            $id = $_POST['delete_id'];
            $this->connect()->query("DELETE FROM calendars where id = '$id' ");
            header("Location:profile.php");

        }

        public function UpdateMeeting()
        {
            $id = $_POST['update_id'];
            $clock = $_POST['clock'];
            $this->connect()->query("UPDATE calendars SET time='$clock' WHERE id = $id");
            // print($id);
            // print($clock);
            header("Location:profile.php");

        }
        
    }
    new Bisness();
?>