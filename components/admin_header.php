<?php

  error_reporting(E_ALL); // reports and logs all errors
  ini_set('display_errors', '1'); //  display the errors directly on the web page

?>

<header>

  <div class="logo">
    <img src="../image/logo.png" alt="alfajorcitos logo" width="150">  <!-- '..' indicates moving up one level in the directory structure. This is a relative path. -->
  </div>

  <div class="right">
    <div class='bx bxs-user' id="user-btn"></div>
    <div class="toggle-btn"><i class="bx bx-menu"></i></div>
  </div>

  <div class="profile-detail">

    <?php
      $select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id=?");
      $select_profile->execute([$seller_id]);

      if ($select_profile->rowCount() > 0) {
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="profile">
      <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img">
      <p><?= $fetch_profile['name']; ?></p>
    </div>

    <div class="flex-btn">
      <a href="profile.php" class="btn">profile</a>
      <a href="../components/admin_logout.php" onclick="return confirm('logout from this website');" class="btn">logout</a>
    </div>

    <?php } ?>

  </div>

</header>

<div class="sidebar">
    
  <?php
    $select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id=?");
    $select_profile->execute([$seller_id]);

    if ($select_profile->rowCount() > 0) {
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
  ?>

    <div class="profile">
        <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" >
        <p><?= $fetch_profile['name']; ?></p>
    </div>

  <?php } ?>

  <h5>menu</h5>
  <div class="navbar">
    <ul>
        <li><a href="dashboard.php"><i class="bx bxs-home-smile"></i>dashboard</a></li>
        <li><a href="add_product.php"><i class="bx bxs-shopping-bags"></i>add products</a></li>
        <li><a href="view_products.php"><i class="bx bxs-food-menu"></i>view products</a></li>
        <li><a href="user_accounts.php"><i class="bx bxs-user-detail"></i>accounts</a></li>
        <li><a href="../components/admin_logout.php" onclick="return confirm('logout from this website');" ><i class="bx bxs-log-out"></i>logout</a></li>
    </ul>
  </div>
  <h5>find us</h5>
  <div class="social-links">
      <i class='bx bxl-facebook'></i>
      <i class="bx bxl-instagram-alt"></i>
      <i class="bx bxl-linkedin"></i>
      <i class="bx bxl-twitter"></i>
      <i class="bx bxl-pinterest-alt"></i>
  </div>
    
</div>
