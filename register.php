<?php

error_reporting(E_ALL); // reports and logs all errors
ini_set('display_errors', '1'); //  display the errors directly on the web page
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
  $user_id = $_COOKIE['user_id'];
} else {
  $user_id = '';
}

if (isset($_POST['register'])) {

  $id = unique_id();
  $name = $_POST['name'];
  //$name = filter_var($name, FILTER_SANITIZE_STRING); // 'FILTER_SANITIZE_STRING' is deprecated.
  $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $email = $_POST['email'];
  //$email = filter_var($email, FILTER_SANITIZE_STRING);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  $pass = sha1($_POST['pass']);
  $cpass = sha1($_POST['cpass']);
  /* Password fields should not be sanitized as they are meant to be hashed for security
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);
  $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
  */

  $image = $_FILES['image']['name'];
  $image = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
  //$image = filter_var($image, FILTER_SANITIZE_STRING); // Sanitize if necessary
  //$ext = pathinfo($image, PATHINFO_EXTENSION);
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  $rename = unique_id() . '.' . $ext;
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = 'uploaded_files/' . $rename;

  $select_user = $conn->prepare("SELECT * FROM `users` WHERE email=?");
  $select_user->execute([$email]);

  if ($select_user->rowCount() > 0) {
    $warning_msg[] = 'email already exist';
  } else {
    if ($pass != $cpass) {
      $warning_msg[] = 'confirm password nor matched';
    } else {
      $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
      $insert_user->execute([$id, $name, $email, $cpass, $rename]);
      move_uploaded_file($image_tmp_name, $image_folder);
      $success_msg[] = 'new user registered! please login now';
    }
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
  <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
  <title>Alfajorcitos - alfajores web site register page</title>
</head>

<body>
  <?php include 'components/user_header.php'; ?>

  <div class="banner">
    <div class="detail">
      <h1>register</h1>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
      <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>register</span>
    </div>
  </div>

  <!-- register form section -->
  <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data" class="register">
      <h3>register now</h3>
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
      <p class="link">already have an account ? <a href="login.php">login now</a></p>
      <input type="submit" name="register" class="btn" value="register now">
    </form>
  </div>


  <?php include 'components/user_footer.php'; ?>
  <!-- sweetalert cdn link -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- custom js link  -->
  <script type="text/javascript" src="js/user_script.js"></script>
  <!-- alert -->
  <?php include 'components/alert.php'; ?>
</body>

</html>