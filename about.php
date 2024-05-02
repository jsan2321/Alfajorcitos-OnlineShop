<?php

error_reporting(E_ALL); // reports and logs all errors
ini_set('display_errors', '1'); //  display the errors directly on the web page

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
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
    <title>Alfajorcitos - alfajores website about us page</title>
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>about us</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>profile</span>
        </div>
    </div>


    <!-- who we are sections -->
    <div class="who" >
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>who we are</span>
                    <h1>We are passionate about creating moments of happiness through our delicious alfajores</h1>
                    <img src="image/separator.png">
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique quod, iure sapiente minus accusamus quia. Dolore architecto mollitia necessitatibus, eveniet quis, adipisci maiores tempora laudantium non nisi cum vitae odio!</p>
                <div class="flex-btn">
                    <a href="menu.php" class="btn" >explore more menu</a>
                    <a href="menu.php" class="btn" >visit our shop</a>
                </div>
            </div>
            <div class="img-box">
                <img src="image/who.jpg" class="img" >
                <img src="image/shap.png" class="shape" >
            </div>
        </div>
    </div>
    <div class="use">
        <div class="box-container">
            <div class="box">
                <img src="image/flowers.png" class="img" >
            </div>
            <div class="box">
                <h1>Prepared for Instant and Convenient Enjoyment</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro non laborum commodi optio molestias. Itaque repellendus unde dolor nam, nesciunt dolores dolorem quam nisi, cum laborum suscipit labore! Culpa, quas.</p>
                <div class="icon">
                    <div class="icon-detail">
                        <div class="img-box"><img src="image/use.png" ></div>
                        <p>quality alfajores</p>
                    </div>
                    <div class="icon-detail">
                        <div class="img-box"><img src="image/use0.png" ></div>
                        <p>smooth & firm texture</p>
                    </div>
                </div>
                <div class="icon">
                    <div class="icon-detail">
                        <div class="img-box"><img src="image/use1.png" ></div>
                        <p>organically grown ingrdients</p>
                    </div>
                    <div class="icon-detail">
                        <div class="img-box"><img src="image/use2.png" ></div>
                        <p>chemical free delights</p>
                    </div>
                </div>
                <div class="flex-btn">
                    <a href="shop.php" class="btn" >shop now</a>
                    <a href="contact.php" class="btn" >call us any time</a>
                </div>
            </div>
        </div>
    </div>


    <?php include 'components/user_footer.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- custom js link  -->
    <!-- <script type="text/javascript" src="js/user_script.js"></script> -->
    <!-- alert -->
    <?php include 'components/alert.php'; ?>

</body>

</html>