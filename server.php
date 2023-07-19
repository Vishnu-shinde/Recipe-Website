<?php
session_start();
$username = "";
$email    = "";
$userprofile = "";
$errors = array();
$_SESSION['success'] = "";

$db = mysqli_connect('localhost', 'root', '', 'recipe');

$errors = array(); 
if (isset($_POST['subbut'])) {
  
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $cpassword = mysqli_real_escape_string($db, $_POST['cpassword']);
    $about = " ";
  
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if (empty($cpassword)) { array_push($errors, "Password is required"); }
  
    if ($password != $cpassword) {
        array_push($errors, "The two passwords do not match");
    }
  
    if (count($errors) == 0) {
         
        $query = "INSERT INTO users (username, email, password, about)
                  VALUES('$username','$email', '$password', '$about')";
         
        mysqli_query($db, $query);
  
        $_SESSION['username'] = $username;
        $_SESSION['email']= $email;
        $_SESSION['success'] = "Account created successfully !";
         
        header('location: Index.php');
    }
}

  
//User login
if (isset($_POST['login'])) {
     
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
         
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        $users = $results;
        
        foreach($users as $user) {
		
             		if(($user['username'] == $username) &&
             			($user['password'] == $password)) {
                             
                            $_SESSION['username'] = $username;
             				header("location: Adminpage.php");
                            echo "welcome"+$user[username];
             		}
             		else {
             			echo "<script language='javascript'>";
             			echo "alert('WRONG INFORMATION')";
             			echo "</script>";
             			die();
             		}
             	}
    }
}

//user post
if(isset($_POST['post'])) {

    $username = $_SESSION['username'];
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $details = mysqli_real_escape_string($db, $_POST['details']);
    $file = mysqli_real_escape_string($db, $_POST['file']);

    if (count($errors) == 0) {
         
        $query = "INSERT INTO post (username, title, details, file)
                  VALUES('$username', '$title', '$details', '$file')";
         
        mysqli_query($db, $query);
  
        $_SESSION['username'] = $username;
        header('location: Adminpage.php');
    }
}


if(isset($_POST['edit'])) {

    $username = $_SESSION['username'];
    $about = mysqli_real_escape_string($db, $_POST['about']);
    
    if (count($errors) == 0) 
    {
        $query = "SELECT * FROM users WHERE username='$username'" ;
        $results = mysqli_query($db, $query);
        $users = $results;

        foreach($users as $user) {
		
            if($user['username'] == $username)
            {
                $query = "UPDATE users set about='$about' WHERE username='$username' ";
                mysqli_query($db, $query);
            }
        }
        
        $_SESSION['about'] = $about;
        header('location: Profile.php');
    }
}