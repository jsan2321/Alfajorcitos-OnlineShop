<?php

  error_reporting(E_ALL); // reports and logs all errors
  ini_set('display_errors', '1'); //  display the errors directly on the web page
  include 'components/connect.php';

  if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
  } else {
    $user_id = '';
  }

  include 'components/add_wishlist.php';
  include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- fetches the Boxicons stylesheet from the CDN (Content Delivery Network). Include and load the Boxicons library to display icons.-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
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

  <div class="products">
    <div class="box-container">
      <?php
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE status = ? LIMIT 6");
        $select_products->execute(['active']);

        if ($select_products->rowCount() > 0) {
          while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>

            <form action="" method="post" class="box" <?php if ($fetch_products['stock'] == 0) {
                                                        echo 'disabled';
                                                      } ?>>
              <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
              <?php if ($fetch_products['stock'] > 9) { ?>
                <span class="stock" style="color:green;">In Stock</span>
              <?php } elseif ($fetch_products['stock'] == 0) { ?>
                <span class="stock" style="color:red;">Out Of Stock</span>
              <?php } else { ?>
                <span class="stock" style="color:red;">Hurry Only <?= $fetch_products['stock']; ?> Left</span>
              <?php } ?>
              <p class="price">Price $ <?= $fetch_products['price']; ?>/-</p>
              <div class="content">
                <div class="button">
                  <div>
                    <h3><?= $fetch_products['name']; ?></h3>
                  </div>
                  <div>
                    <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                    <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                    <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                  </div>
                </div>
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <div class="flex-btn">
                  <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">buy now</a>
                  <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                </div>
              </div>
            </form>

      <?php
          }
        } else {
          echo '    
                  <div class="empty" >
                      <p>no products added yet!</p>
                  </div>
              ';
        }
      ?>
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