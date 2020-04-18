<?php
   include('sessiontest.php');
?>
<html">
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_username; ?></h1> 
      <h2><a href = "logouttest.php">Sign Out</a></h2>
   </body>
   
</html>