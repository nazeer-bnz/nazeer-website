<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
  
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = md5($_POST['password']);
  $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) >0){

    $row = mysqli_fetch_array($result);

    if($row['user_type']=='admin'){

        $_SESSION['admin_name'] = $row['name'];
        header('Location:admin.php');

    }elseif($row['user_type']=='user'){

        $_SESSION['user_name'] = $row['name'];
        header('Location:user.php');
    }
  }else{
    $error[] = 'incorrect email or password!';
  }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="form-container">
        <form action="" method="post">
          <h3>Login Now</h3>
          
          <?php
          if(isset($error)){
            foreach($error as $error){
              echo '<span class="error-msg">'.$error.'</span>';
            };
          };

         ?>

          <input type="email" name="email" required placeholder="enter your email">
          <input type="password" name="password" required placeholder="enter your password">
          <input type="submit" name="submit" value="login now" class="form-btn">
          <p>you don't have an account? <a href="register.php">register now</a></p>
        </form>
    </div>
</body>
</html>