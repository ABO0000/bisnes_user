<?php
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
                if ($email !== 'admin@gmail.com') {
                    $this->connect()->query("INSERT INTO users (name,surname,email, password,type) VALUES ('$name', '$surname','$email','$password',0)");
                    header("Location:index.php");
                } else {
                    $this->connect()->query("INSERT INTO users (name,surname,email, password,type) VALUES ('$name', '$surname','$email','$password',1)");
                    header("Location:index.php");
                }
            }
            // $d = $this->connect()->query
        }
        // print $d + 5;
        // print_r( mysqli_error($d) );
        // header("Location:profile.php");
        // print "<pre>";
        // print_r($errors);
    }
    new Bisness();
?>