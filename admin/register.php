<?php

error_reporting(E_ALL); // reports and logs all errors
ini_set('display_errors', '1'); //  display the errors directly on the web page
include '../components/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fetches the Boxicons stylesheet from the CDN (Content Delivery Network). Include and load the Boxicons library to display icons.-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>"> <!-- appending a query parameter to the URL, which includes the current timestamp -->
    <title>Alfajorcitos - alfajores web site vendor registration page</title>
  </head>

  <body>
    <div class="form-container">
      <form action="" method="post" accept="multipart/form-data" class="register">
        <div class="flex">
          <div class="col">
            <div class="input-field">
              <p>your name <span>*</span></p>
              <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
            </div>
            <div class="input-field">
              <p>your email <span>*</span></p>
              <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
            </div>
          </div>
          <div class="col">
            <div class="input-field">
              <p>your password <span>*</span></p>
              <input type="password" name="pass" placeholder="enter your password" maxlength="50" required class="box">
            </div>
            <div class="input-field">
              <p>confirm password <span>*</span></p>
              <input type="password" name="cpass" placeholder="enter your password" maxlength="50" required class="box">
            </div>
          </div>
        </div>
        <div class="input-field">
          <p>select profile <span>*</span></p>
          <input type="file" name="image" accept="image/*" required class="box">
        </div>
        <input type="submit" name="register" class="btn" value="register now">
      </form>
    </div>




    <!-- sweetalert cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- custom js link  -->
    <script type="text/javascript" src="../js/admin_scripts.js"></script>
    <!-- alert -->
    <?php include '../components/alert.php' ?>

  </body>

</html>