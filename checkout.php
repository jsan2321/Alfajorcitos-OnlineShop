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
    <title>Alfajorcitos - alfajores web site checkout page</title>
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>checkout</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>checkout</span>
        </div>
    </div>

    <section class="checkout">
        <div class="heading">
            <h1>checkout summary</h1>
            <img src="image/separator.png">
        </div>
        <div class="row">
            <div class="form-container">
                <form method="post" class="register">
                    <input type="hidden" name="p_id" value="<?= $get_id; ?>">
                    <h3>billing details</h3>
                    <div class="flex">
                        <div class="col">
                            <div class="input-field">
                                <p>your name <span>*</span></p>
                                <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>your number <span>*</span></p>
                                <input type="number" name="number" placeholder="enter your number" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>your email <span>*</span></p>
                                <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>payment status <span>*</span></p>
                                <select name="method" class="box">
                                    <option value="cash on Delivery">cash on delivery</option>
                                    <option value="credit or debit cart">credit or debit cart</option>
                                    <option value="net banking">net banking</option>
                                    <option value="Global or CiBank">Global or CiBank</option>
                                    <option value="paype">paype</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <p>address type <span>*</span></p>
                                <select name="address_type" class="box">
                                    <option value="home">home</option>
                                    <option value="office">office</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-field">
                                <p>address line 01 <span>*</span></p>
                                <input type="text" name="flat" placeholder="e.g flat & building" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>address line 01 <span>*</span></p>
                                <input type="text" name="street" placeholder="e.g street name" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>city name <span>*</span></p>
                                <input type="email" name="city" placeholder="enter your city name" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>country name <span>*</span></p>
                                <input type="email" name="country" placeholder="enter your country name" maxlength="50" required class="box">
                            </div>
                            <div class="input-field">
                                <p>pincode <span>*</span></p>
                                <input type="number" name="pin" placeholder="10001" maxlength="6" required class="box">
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="place_order" class="btn">place order</button>
                </form>
            </div>
            <div class="summary">
                <h3>my bag</h3>
                <div class="box-container">
                    <?php

                    $grand_total = 0;
                    if (isset($_GET['get_id'])) {
                        $select_get = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                        $select_get->execute([$_GET['get_id']]);

                        while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                            $sub_total = $fetch_get['price'];
                            $grand_total += $sub_total;

                    ?>
                            <div class="flex">
                                <img src="uploaded_files/<?= $fetch_get['image']; ?>" class="image">
                                <div>
                                    <h3 class="name"><?= $fetch_get['name']; ?></h3>
                                    <p class="price">$<?= $fetch_get['price']; ?></p>
                                </div>
                            </div>
                            <?php

                        }
                    } else {
                        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                        $select_cart->execute([$user_id]);

                        if ($select_cart->rowCount() > 0) {
                            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {

                                $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                                $select_products->execute([$fetch_cart['product_id']]);
                                $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                                $sub_total = ($fetch_cart['qty'] * $fetch_product['price']);
                                $grand_total += $sub_total;

                            ?>
                                <div class="flex">
                                    <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image">
                                    <div>
                                        <h3 class="name"><?= $fetch_product['name']; ?></h3>
                                        <p class="price">$<?= $fetch_product['price']; ?> X <?= $fetch_cart['qty']; ?></p>
                                    </div>
                                </div>
                    <?php

                            }
                        } else {
                            echo '    
                                <div class="empty" >
                                    <p>no products added yet!</p>
                                </div>
                            ';
                        }
                    }

                    ?>
                </div>
                <div class="grand-total"><span>total amount payable : </span>$<?= $grand_total; ?>/-</div>
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