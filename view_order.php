<?php

error_reporting(E_ALL); // reports and logs all errors
ini_set('display_errors', '1'); //  display the errors directly on the web page
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = 'login.php';
}

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:order,php');
}

if(isset($_POST['canceled'])) {
    $update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
    $update_order->execute(['canceled', $get_id]);
    header('location:order.php');
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
            <h1>order detail</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>order detail</span>
        </div>
    </div>

    <!-- register form section -->
    <div class="view_order">
        <div class="heading">
            <h1>order detail</h1>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <?php

            $grand_total = 0;
            $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
            $select_order->execute([$get_id]);

            if ($select_order->rowCount() > 0) {
                while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {
                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                    $select_product->execute([$fetch_order['product_id']]);

                    if ($select_order->rowCount() > 0) {
                        while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                            $sub_total = ($fetch_order['price'] * $fetch_order['qty']);
                            $grand_total += $sub_total;

            ?>
            <div class="box">
                <div class="col">
                    <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" >
                    <p class="date"><i class="bx bxs-calendar-alt" ></i><?= $fetch_order['date_time'] ?></p>
                    <div class="detail">
                        <p class="price"><?= $fetch_product['price']; ?>X<?= $fetch_order['qty'] ?></p>
                        <h3 class="name"><?= $fetch_product['name']; ?></h3>
                        <p class="grand-total">total amount payable : <span>$<?= $grand_total; ?></span></p>
                    </div>
                </div>
                <div class="col">
                    <p class="title">billing address</p>
                    <p class="user"><i class="bx bxs-user-rectangle" ></i><?= $fetch_order['name']; ?></p>
                    <p class="user"><i class="bx bxs-phone-outgoing" ></i><?= $fetch_order['number']; ?></p>
                    <p class="user"><i class="bx bxs-envelope" ></i><?= $fetch_order['email']; ?></p>
                    <p class="user"><i class="bx bxs-map-alt" ></i><?= $fetch_order['address']; ?></p>
                    <p class="title">status</p>
                    <p class="status" style="color:<?php if ($fetch_order['status'] == 'delivered') {
                                                                                echo "green";
                                                                            } elseif ($fetch_order['status'] == "canceled") {
                                                                                echo "red";
                                                                            } else {
                                                                                echo "orange";
                                                                            } ?>"><?= $fetch_order['status']; ?></p>
                    <?php if($fetch_order['status'] == 'canceled') { ?>
                        <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn" >order again</a>
                    <?php } else { ?>
                        <form method="post">
                            <button type="submit" name="canceled" class="btn" onclick="return confirm('do you want to cancel this product');" >canceled</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
            <?php

                        }
                    }
                } 
            } else {
                echo '
                
                    <div class="empty">
                        <p>no </p>
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