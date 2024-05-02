<?php

    error_reporting(E_ALL); // reports and logs all errors
    ini_set('display_errors', '1'); //  display the errors directly on the web page

    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else {
        $user_id = 'login.php'; 
    }

    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
    $select_orders->execute([$user_id]);
    $total_orders = $select_orders->rowCount();

    $select_message = $conn->prepare("SELECT * FROM `message` WHERE user_id = ?");
    $select_message->execute([$user_id]);
    $total_message = $select_message->rowCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- fetches the Boxicons stylesheet from the CDN (Content Delivery Network). Include and load the Boxicons library to display icons.-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>"> <!-- appending a query parameter to the URL, which includes the current timestamp -->
  <title>Alfajorcitos - alfajores web site profile page</title>
</head>

<body>
  <?php include 'components/user_header.php'; ?>

  <div class="banner">
    <div class="detail">
      <h1>profile</h1>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
      <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>profile</span>
    </div>
  </div>

  <!-- user profile section -->
  <section class="profile" >
    <div class="heading">
        <h1>profile detail</h1>
        <img src="image/separator.png" >
    </div>
    <div class="details">
        <div class="user">
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>" >
            <h3><?= $fetch_profile['name']; ?></h3>
            <p>user</p>
            <a href="update.php" class="btn" >update profile</a>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="flex">
                    <i class="bx bxs-food-menu" ></i>
                    <h3><?= $total_orders; ?></h3>
                </div>
                <a href="order.php" class="btn" >view orders</a>
            </div>
            <div class="box">
                <div class="flex">
                    <i class="bx bxs-chat" ></i>
                    <h3><?= $total_message; ?></h3>
                </div>
                <a href="contact.php" class="btn" >send messages</a>
            </div>
        </div>
    </div>
  </section>


  <?php include 'components/user_footer.php'; ?>
  <!-- sweetalert cdn link -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- custom js link  -->
  <script type="text/javascript" src="js/user_script.js"></script>
  <!-- alert -->
  <?php include 'components/alert.php'; ?>

</body>

</html>