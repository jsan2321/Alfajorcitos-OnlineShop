<?php

  error_reporting(E_ALL); // reports and logs all errors
  ini_set('display_errors', '1'); //  display the errors directly on the web page
  include 'components/connect.php';
  
  if(isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
  } else {
    $user_id = '';
  }

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fetches the Boxicons stylesheet from the CDN (Content Delivery Network). Include and load the Boxicons library to display icons.-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>   
    <link rel="stylesheet" type="text/css" href="../css/user_style.css?v=<?php echo time(); ?>"> 
    <title>Alfajorcitos - alfajores web site shop page</title>
  </head>

  <body>
    <?php include 'components/user_header.php'; ?>

    <div class="banner">
      <div class="detail">
        <h1>latest products</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>latest products</span>
      </div>
    </div>



    <?php include 'components/user_footer.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- custom js link  -->
    <!-- <script type="text/javascript" src="../js/user_script.js"></script> -->
    <!-- alert -->
    <?php include 'components/alert.php'; ?>
  </body>

</html>