<?php

  error_reporting(E_ALL); // reports and logs all errors
  ini_set('display_errors', '1'); //  display the errors directly on the web page
  include '../components/connect.php';

  if(isset($_POST['login'])){

   
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $pass = sha1($_POST['pass']);
 
    $select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE email=? AND password=? LIMIT 1");
    $select_seller->execute([$email, $pass]);
    $row = $select_seller->fetch(PDO::FETCH_ASSOC);

    if ($select_seller->rowCount() > 0) {
        setcookie('seller_id', $row['id'], time() + 60*69*24*38, '/');
        header('location:dashboard.php');
    } else {
        $warning_msg[] = 'incorrect email or password!';
    }

    
  
  }
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
      <form action="" method="post" enctype="multipart/form-data" class="login">
        <h3>login now</h3>
        <div class="input-field">
            <p>your email <span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
        </div>
        <div class="input-field">
            <p>your password <span>*</span></p>
            <input type="password" name="pass" placeholder="enter your password" maxlength="50" required class="box">
        </div>
        <p class="link">do not have an account ? <a href="register.php">register now</a></p>
        <input type="submit" name="login" class="btn" value="login now">
      </form>
    </div>

    <!-- sweetalert cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- custom js link  -->
    <script type="text/javascript" src="../js/admin_scripts.js"></script>
    <!-- alert -->
    <?php include '../components/alert.php'; ?>

  </body>

</html>