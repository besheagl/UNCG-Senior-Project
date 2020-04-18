<?php
   include('config.php');
   session_start();
   
  $user_check = $_SESSION['login_username'];
   
   $ses_sql = mysqli_query($db,"select username from accounts where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_username = $row['username'];
   
   if(!isset($_SESSION['login_username'])){
      header("location:profileshows.php");
      die();
   }
?>