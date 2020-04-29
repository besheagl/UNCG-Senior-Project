<?php
    session_start();
    include('connect.php');
    $user_check=$_SESSION["login_username"];
    // SQL Query To Fetch Complete Information Of User
    $ses_sql=mysql_query("select username from accounts where username='$login_username'", $con);
    $row = mysql_fetch_assoc($ses_sql);
    $login_session =$row['username'];
    if(!isset($login_session)){
    mysql_close($con); // Closing Connection
    header('Location: login.php'); // Redirecting To try again
}
?>