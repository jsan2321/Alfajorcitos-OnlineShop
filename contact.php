<?php

error_reporting(E_ALL); // reports and logs all errors
ini_set('display_errors', '1'); //  display the errors directly on the web page
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
  $user_id = $_COOKIE['user_id'];
} else {
  $user_id = '';
}

if (isset($_POST['send_message'])) {

  if ($user_id != '') {
    $id = unique_id(); 

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $subject = $_POST['subject'];
    $subject = filter_var($subject, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $message = $_POST['message'];
    $message = filter_var($message, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ?");
    $verify_message->execute([$user_id, $name, $email, $subject, $message]);

    if ($verify_message->rowCount() > 0) {
      $warning_msg[] = 'message already send';
    } else {
      $insert_message = $conn->prepare("INSERT INTO `message` (id, user_id, name, email, subject, message) VALUES(?,?,?,?,?,?)");
      $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);
      $success_msg[] = 'message send';
    }
  } else {
    $warning_msg[] = 'please login first';
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
  <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>"> <!-- appending a query parameter to the URL, which includes the current timestamp -->
  <title>Alfajorcitos - alfajores web site vendor contact page</title>
</head>

<body>
  <?php include 'components/user_header.php'; ?>

  <div class="banner">
    <div class="detail">
      <h1>contact us</h1>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
      <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>contact us</span>
    </div>
  </div>

  <!-- service section -->
  <div class="service">
    <div class="heading">
      <h1>our services</h1>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt saepe repudiandae, ratione est, in voluptatibus tempora officiis voluptatem doloribus nisi perspiciatis molestiae aliquam possimus id deserunt ad laboriosam veniam ex!</p>
      <img src="image/separator.png">
    </div>
    <div class="box-container">
      <div class="box">
        <img src="image/delivery.png">
        <div>
          <h1>free shipping fast</h1>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
        </div>
      </div>
      <div class="box">
        <img src="image/return.png">
        <div>
          <h1>money back guarantee</h1>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
        </div>
      </div>
      <div class="box">
        <img src="image/discount.png">
        <div>
          <h1>online support 24/7</h1>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="contact">
    <div class="heading">
      <h1>drop a line</h1>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt saepe repudiandae, ratione est, in voluptatibus tempora officiis voluptatem doloribus nisi perspiciatis molestiae aliquam possimus id deserunt ad laboriosam veniam ex!</p>
      <img src="image/separator.png">
    </div>
    <div class="form-container">
      <form action="" method="post" enctype="multipart/form-data" class="login">
        <div class="input-field">
          <p>your name <span>*</span></p>
          <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
        </div>
        <div class="input-field">
          <p>your email <span>*</span></p>
          <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
        </div>
        <div class="input-field">
          <p>subject <span>*</span></p>
          <input type="text" name="subject" placeholder="enter your name" maxlength="50" required class="box">
        </div>
        <div class="input-field">
          <p>message <span>*</span></p>
          <textarea name="message" class="box"></textarea>
        </div>
        <button type="submit" name="send_message" class="btn">send message</button>
      </form>
    </div>
  </div>

  <!-- contact form section -->
  <div class="address">
    <div class="heading">
      <h1>our contact details</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam iste dignissimos <br> reiciendis exercitationem voluptatem facilis eaque ipsa eveniet expedita aspernatur in consectetur iure eum alias, dolorum dolore, excepturi nulla ullam.</p>
      <img src="image/separator.png">
    </div>
    <div class="box-container">
      <div class="box">
        <i class="bx bxs-map-alt" ></i>
        <div>
          <h4>address</h4>
          <p>1093 Marigold Lane, Coral Way <br>Miami, Florida, 33169</p>
        </div>
      </div>
      <div class="box">
        <i class="bx bxs-phone-incoming" ></i>
        <div>
          <h4>phone number</h4>
          <p>2233445544</p>
          <p>7788997766</p>
        </div>
      </div>
      <div class="box">
        <i class="bx bxs-envelope" ></i>
        <div>
          <h4>email</h4>
          <p>selenaansari@gmail.com</p>
          <p>selenaansari47@gmail.com</p>
        </div>
      </div>
    </div>
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