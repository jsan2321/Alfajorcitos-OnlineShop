<?php

  session_start(); 

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
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $verify_delete = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
    $verify_delete->execute([$cart_id]);

    if($verify_delete->rowCount() > 0) {
        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE id=?");
        $delete_cart->execute([$cart_id]);
        $success_msg[] = 'cart item delete successfully';
    }else{
        $warning_msg[] = 'cart item already deleted';
    }
  }

  // update quantity
  if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);

    $success_msg[] = 'cart quantity updated';
    //$_SESSION['success_msg']  = 'cart quantity updated';
  }

  //empty cart
  if(isset($_POST['empty_cart'])) {
    $verify_empty_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
    $verify_empty_item->execute([$user_id]);

    if($verify_empty_item->rowCount() > 0) {
        $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart_item->execute([$user_id]);
        $success_msg[] = 'empty cart successfully';
    } else {
        $warning_msg[] = 'your cart is already empty';
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
  <title>Alfajorcitos - alfajores web site cart page</title>
</head>

<body>
  <?php include 'components/user_header.php'; ?>

  <div class="banner">
    <div class="detail">
      <h1>cart</h1>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
      <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>cart</span>
    </div>
  </div>

  <!-- product detail section -->
  <section class="products">
    <div class="heading">
        <h1>products added in your cart</h1>
        <img src="image/separator.png">
    </div>

    <div class="box-container">
        <?php
            
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
            $select_cart->execute([$user_id]);

            if($select_cart->rowCount() > 0) {
                while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id=?");
                    $select_products->execute([$fetch_cart['product_id']]);

                    if($select_products->rowCount() > 0) {
                        $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)

        ?>
                        <form method="post" class="box <?php if($fetch_products['stock']==0){echo 'disabled';}; ?>">
                            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id'] ?>">
                                <img src="uploaded_files/<?= $fetch_products['image'] ?>" class="image" >
                                <?php if ($fetch_products['stock'] > 9) { ?>
                                    <span class="stock" style="color: green;">In Stock</span>
                                <?php } elseif ($fetch_products['stock'] == 0) { ?>
                                    <span class="stock" style="color: red;">out stock</span>
                                <?php } else { ?>
                                    <span class="stock" style="color: red;">Hurry Only <?= $fetch_products['stock'] ?> Left</span>
                                <?php } ?>         
                                <p class="price" >price $<?= $fetch_products['price']; ?></p>
                                <div class="content cart-content">
                                    <div class="flex-btn">
                                        <h3 class="name" ><?= $fetch_products['name']; ?></h3>
                                        <p class="sub-total">sub total : $<?= $sub_total = ($fetch_cart['qty']*$fetch_cart['price']); ?></p>
                                    </div>
                                    <div class="flex-btn">
                                        <input type="number" name="qty" required min="1" value="<?= $fetch_cart['qty']; ?>" max="99" maxlength="2" class="qty">
                                        <button type="submit" name="update_cart" class="bx bxs-edit fa-edit" style="box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.40);" ></button>
                                        <button type="submit" name="delete_item" onclick="return confirm('delete this product');" class="btn" >delete</button>
                                    </div>
                                </div>
                        </form>
        <?php
                    $grand_total += $sub_total;
        
                    } else {
                        echo '    
                            <div class="empty" >
                                <p>no products found!</p>
                            </div>
                        ';
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
    <?php 
     
        if($grand_total != 0) {

    ?>

            <div class="cart-total">
                <p>total amount payable : <span>$ <?= $grand_total; ?>/-</span></p>
                <div class="button">
                    <form method="post">
                        <button type="submit" name="empty_cart" onclick="return confirm('are you sure to empty cart');" class="btn" >empty cart</button>
                        <a href="cheackout.php" class="btn" >proceed to checkout</a>
                    </form>
                </div>
            </div>

    <?php } ?>
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