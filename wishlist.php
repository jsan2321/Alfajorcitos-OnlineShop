<?php

  error_reporting(E_ALL); // reports and logs all errors
  ini_set('display_errors', '1'); //  display the errors directly on the web page
  include 'components/connect.php';

  if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
  } else {
    $user_id = 'login.php';
  }


  // remove product from wishlist

  if(isset($_POST['delete_item'])) {
    $wishlist_id = $_POST['wishlist_id'];
    $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $verify_delete = $conn->prepare("SELECT * FROM `wishlist` WHERE id = ?");
    $verify_delete->execute([$wishlist_id]);

    if($verify_delete->rowCount() > 0) {
        $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE id=?");
        $delete_wishlist->execute([$wishlist_id]);
        $success_msg[] = 'wishlist item delete successfully';
    }else{
        $warning_msg[] = 'wishlist item already deleted';
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
  <title>Alfajorcitos - alfajores web site wishlist page</title>
</head>

<body>
  <?php include 'components/user_header.php'; ?>

  <div class="banner">
    <div class="detail">
      <h1>wishlist</h1>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
      <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>wishlist</span>
    </div>
  </div>

  <!-- product detail section -->
  <section class="products">
    <div class="heading">
        <h1>products added in your wishlist</h1>
        <img src="image/separator.png">
    </div>

    <div class="box-container">
        <?php
        
            $grand_total = 0;
            $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id=?");
            $select_wishlist->execute([$user_id]);

            if($select_wishlist->rowCount() > 0) {
                while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id=?");
                    $select_products->execute([$fetch_wishlist['product_id']]);

                    if($select_products->rowCount() > 0) {
                        $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)

        ?>


        <form action="" method="post" class="box <?php if($fetch_products['stock']==0){echo 'disabled';}; ?>" >
            <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id'] ?>">
            <img src="uploaded_files/<?= $fetch_products['image'] ?>" class="image" >
            <?php if ($fetch_products['stock'] > 9) { ?>
                <span class="stock" style="color: green;">In Stock</span>
            <?php } elseif ($fetch_products['stock'] == 0) { ?>
                <span class="stock" style="color: red;">out stock</span>
            <?php } else { ?>
                <span class="stock" style="color: red;">Hurry Only <?= $fetch_products['stock'] ?> Left</span>
            <?php } ?>
            <div class="flex">
                <p class="price" >price $<?= $fetch_products['price']; ?></p>
            </div>
            <div class="content">
                <div class="button">
                    <div><h3 class="name"><?= $fetch_products['name']; ?></h3></div>
                    <div>
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                        <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bx-show"></a>
                        <button type="submit" name="delete_item" onclick="return confirm('delete this product');"><i class="bx bx-x" ></i></button>
                    </div>
                </div>
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>" >
                <div class="flex">
                    <input type="hidden" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                    <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn" style="width: 100% !important;" >buy now</a>
                </div>
            </div>
        </form>
        
        <?php
        
                    }
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