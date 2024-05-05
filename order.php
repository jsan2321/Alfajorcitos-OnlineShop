<?php

error_reporting(E_ALL); // reports and logs all errors
ini_set('display_errors', '1'); //  display the errors directly on the web page
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = 'login.php';
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
    <title>Alfajorcitos - alfajores web site my orders page</title>
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>my orders page</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>my orders page</span>
        </div>
    </div>

    <!-- register form section -->
    <div class="orders">
        <div class="heading">
            <h1>my orders</h1>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <?php

            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);

            if ($select_orders->rowCount() > 0) {
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                    $product_id = $fetch_orders['product_id'];
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_products->execute([$fetch_orders['product_id']]);
                    if ($select_products->rowCount() > 0) {
                        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {

            ?>
                            <div class="box">
                                <a href="view_order.php?get_id=<?= $fetch_orders['id']; ?>">
                                    <img src="uploaded_files/<?= $fetch_products['image']; ?>">
                                    <div class="content">
                                        <p class="date"><i class="bx bxs-calendar-alt"></i><span><?= $fetch_orders['date_time']; ?></span></p>
                                        <div class="row">
                                            <h3 class="name"><?= $fetch_products['name']; ?></h3>
                                            <p class="price"><?= $fetch_products['price']; ?></p>
                                            <p class="status" style="color:<?php if ($fetch_orders['status'] == 'delivered') {
                                                                                echo "green";
                                                                            } elseif ($fetch_orders['status'] == "canceled") {
                                                                                echo "red";
                                                                            } else {
                                                                                echo "orange";
                                                                            } ?>"><?= $fetch_orders['status']; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
            <?php

                        }
                    }
                }
            } else {
                echo '
                
                    <div class="empty">
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