<?php

error_reporting(E_ALL); // reports and logs all errors
ini_set('display_errors', '1'); //  display the errors directly on the web page
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
  $seller_id = $_COOKIE['seller_id'];
} else {
  $seller_id = '';
  header('location:login.php');
}

$select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id=?");
$select_products->execute([$seller_id]);
$total_products = $select_products->rowCount();

$select_orders = $conn->prepare("SELECT * FROM `products` WHERE seller_id=?");
$select_orders->execute([$seller_id]);
$total_orders = $select_orders->rowCount(); 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- fetches the Boxicons stylesheet from the CDN (Content Delivery Network). Include and load the Boxicons library to display icons.-->
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>" > <!-- appending a query parameter to the URL, which includes the current timestamp -->
      <title>Admin - Dashboard</title>
  </head>
  <body>

    <?php include '../components/admin_header.php'?>
    <div class="banner">
      <div class="detail">
        <h1>seller profile</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>profile</span>
      </div>
    </div>

    <section class="seller_profile">
      <div class="heading">
        <h1>seller profile</h1>
        <img src="../image/separator.png" width="100">
      </div>

      <div class="detail">
        <div class="seller">
          <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" width="150" height="150">
          <h3><?= $fetch_profile['name']; ?></h3>
          <span>sellers</span>
          <a href="update.php" class="btn">update profile</a>
        </div> 
        <div class="flex">
          <div class="box">
            <span><?= $total_products; ?></span>
            <p>total products</p>
            <a href="view_product.php" class="btn">view products</a>
          </div>
          <div class="box">
            <span><?= $total_orders; ?></span>
            <p>total orders placed</p>
            <a href="admin_order.php" class="btn">view orders</a>
          </div>
        </div> 
      </div>
    
    </section>

    <?php include '../components/admin_footer.php'?>

    <!-- sweetalert cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- custom js link  -->
    <script type="text/javascript" src="../js/admin_scripts.js"></script>
    <!-- alert -->
    <?php include '../components/alert.php' ?>

  </body>
</html>