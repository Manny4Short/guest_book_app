<?php 
session_start();     

$errors = "";
$servername = "localhost"; 
$username ="root";
$password = '';
$dbname = 'guestbook';

// connect to database
$conn = mysqli_connect( $servername,$username ,$password);

// check connection 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error().'<br>');
}

// Create database guestbook
$sql = "CREATE DATABASE IF NOT EXISTS guestbook";
if (mysqli_query($conn, $sql)) {
echo "".'';
} else {
echo "Error creating database: " . mysqli_error($conn).'<br>';
}

// Create table guestlist
$sql = "CREATE TABLE IF NOT EXISTS guestlist(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255),
    surname VARCHAR(255),
    logged_in DATETIME DEFAULT CURRENT_TIMESTAMP,
    gender char(1),
    mobile_no VARCHAR(18)
    
)";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_query($conn, $sql)){
  echo  "".'';
} else {
echo "Error creating guestlist table: " . mysqli_error($conn).'<br>';
}

// Create table user
$sql = "CREATE TABLE IF NOT EXISTS user(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    psw VARCHAR(255),
    user_type  VARCHAR(255) DEFAULT 'guest'
)";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_query($conn, $sql)){
  echo  "".'';
} else {
echo "Error creating user table: " . mysqli_error($conn).'<br>';
}

// insert if submit button is clicked
if (isset($_POST['submit'])) {

    if (empty($_POST['firstname'] & $_POST['surname'] & $_POST['gender'] & $_POST['mobile_no'])) {
        $errors = "Kindly fill in all the details ";
    }else{
        $firstname = $_POST['firstname'];			
        $surname = $_POST['surname'];	
        $gender = $_POST['gender'];
        $mobile_num = $_POST['mobile_no'];		
        $query = "INSERT INTO guestlist(firstname, surname, gender, mobile_no) VALUES('$firstname','$surname', '$gender', '$mobile_num')";

        if (mysqli_query($conn, $query)){
            echo '';
        }else {
            echo 'error logging list:'.mysqli_error($conn).'<br>';
        };
        // header('location: attendance.php');
    }
}	


// delete task
if (isset($_GET['del_guest'])) {
    $id = $_GET['del_guest'];

    mysqli_query($conn, "DELETE FROM guestlist WHERE id=".$id);
    // header('location: admin.php');
}

    // Sign up new user
    //insert sign-up details into database
    if (isset($_POST['sign-up'])) {

        if (empty($_POST['email'] & $_POST['psw'] & $_POST['psw-repeat'])) {
            $errors = "Kindly fill in all the details ";
        }else{
            $email = $_POST['email'];
            if ($_POST['psw'] == $_POST['psw-repeat']){
            $psw = md5($_POST['psw']);            	
            }else{
                echo 'Password confirmation incorrect';
            }
                
            $query = "INSERT INTO user(email, psw ) VALUES('$email','$psw')";

            if (mysqli_query($conn, $query)){
                // $_SESSION["user-created"] = "yes";
                header('location: index.php');
            }else {
                echo 'error creating user:'.mysqli_error($conn).'<br>';
            };
            // header('location: attendance.php');
        }
    }	
    
    // login users both admin and guests

    if(isset($_POST['login'])){
        if (empty($_POST['email-login'] & $_POST['psw-login'])){
            echo 'Kindly enter both email and password';
        }else {
        $email_login = $_POST['email-login'];
        $psw_login = md5($_POST['psw-login']);
        }   

        $sql = "SELECT * FROM `user` WHERE email ='$email_login'  AND psw = '$psw_login'";
        $result = mysqli_query($conn,$sql);        
        while($row = mysqli_fetch_assoc($result)){
           if ($email_login ==  $row['email'] & $psw_login == $row['psw'] & $row['user_type'] == 'guest'){
               header('location: guest.php ');
           }elseif ($email_login ==  $row['email'] & $psw_login == $row['psw'] & $row['user_type'] == 'admin'){
                header('location: admin.php '); 
           }

        }   
    }
?>