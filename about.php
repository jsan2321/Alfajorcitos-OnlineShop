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
    <div class="who">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>who we are</span>
                    <h1>We are passionate about creating moments of happiness through our delicious alfajores</h1>
                    <img src="image/separator.png">
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique quod, iure sapiente minus accusamus quia. Dolore architecto mollitia necessitatibus, eveniet quis, adipisci maiores tempora laudantium non nisi cum vitae odio!</p>
                <div class="flex-btn">
                    <a href="menu.php" class="btn">explore more menu</a>
                    <a href="menu.php" class="btn">visit our shop</a>
                </div>
            </div>
            <div class="img-box">
                <img src="image/who.jpg" class="img">
                <img src="image/shap.png" class="shape">
            </div>
        </div>
    </div>
    <div class="use">
        <div class="box-container">
            <div class="box">
                <img src="image/alfajores.png" class="img">
            </div>
            <div class="box">
                <h1>Prepared for Instant and Convenient Enjoyment</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro non laborum commodi optio molestias. Itaque repellendus unde dolor nam, nesciunt dolores dolorem quam nisi, cum laborum suscipit labore! Culpa, quas.</p>
                <div class="icon">
                    <div class="icon-detail">
                        <div class="img-box"><img src="image/use.png"></div>
                        <p>The highest quality</p>
                    </div>
                    <div class="icon-detail">
                        <div class="img-box"><img src="image/use0.png"></div>
                        <p>smooth & firm texture</p>
                    </div>
                </div>
                <div class="icon">
                    <div class="icon-detail">
                        <div class="img-box"><img src="image/use1.png"></div>
                        <p>organic ingredients</p>
                    </div>
                    <div class="icon-detail">
                        <div class="img-box"><img src="image/use2.png"></div>
                        <p>chemical free delights</p>
                    </div>
                </div>
                <div class="flex-btn">
                    <a href="shop.php" class="btn">shop now</a>
                    <a href="contact.php" class="btn">call us any time</a>
                </div>
            </div>
        </div>
    </div>

    <!-- cms banner section -->
    <div class="cms-banner">
        <div class="box-container">
            <div class="box">
                <img src="image/cms-banner.avif">
                <div class="detail">
                    <span>flat 35% discount</span>
                    <h1>artisanal & delicious <br>alfajores</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src="image/cms-banner.jpg">
                <div class="detail">
                    <span>flat 15% discount</span>
                    <h1>artisanal & delicious <br>alfajores</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- story section -->
    <div class="story">
        <div class="box">
            <div class="heading">
                <span>fresh & delicious</span>
                <h1>Discount up to 30% for our <br> first purchase.</h1>
            </div>
            <p style="color: red; text-transform: uppercase; padding-bottom: .5rem;">get 20% extra</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat atque excepturi mollitia saepe aut enim ullam quisquam harum expedita illum voluptates ab fuga, possimus odio corporis est voluptate iste minima.</p>
            <a href="" class="btn">our services</a>
        </div>
    </div>

    <!-- team section -->
    <div class="team">
        <div class="heading">
            <span>our team</span>
            <h1>Quality & Passion with our Services!</h1>
            <img src="image/separator.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/team.avif" class="img">
                <div class="content">
                    <h2>fiona edwards</h2>
                    <p>pastry chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team0.jpg" class="img">
                <div class="content">
                    <h2>ralph johnson</h2>
                    <p>quality control</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team2.avif" class="img">
                <div class="content">
                    <h2>selena ansari</h2>
                    <p>packaging and labeling</p>
                </div>
            </div>
        </div>
    </div>
    <!-- about section -->
    <div class="about">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>About Company</span>
                    <h1>Producers of Authentic and Delicious Alfajores</h1>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto expedita illum optio, molestias consequatur neque ipsam distinctio, accusantium eius, beatae eaque hic soluta delectus provident voluptatibus error voluptatem veritatis. Neque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, eaque suscipit vel illum numquam magni aliquam sequi. Adipisci amet praesentium quia obcaecati deleniti corporis sint, in minus hic vel at!</p>
            </div>
        </div>
    </div>

    <!-- why choose us section -->
    <div class="choose">
        <div class="box-container">
            <div class="img-box">
                <img src="image/about.jpg" alt="">
            </div>
            <div class="box">
                <div class="heading">
                    <span>why choose us</span>
                    <h1>Special Care In Our <br> Customer Service</h1>
                </div>
                <div class="box-detail">
                    <div class="detail">
                        <img src="image/discount.png">
                        <h2>discount options</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, at? Sed vero eos molestias adipisci asperiores nemo, nobis quam, culpa provident numquam eius, beatae voluptatum magnam vel itaque? Accusamus, assumenda?</p>
                        <span>1</span>
                    </div>
                    <div class="detail">
                        <img src="image/gift.png">
                        <h2>gift offers</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, at? Sed vero eos molestias adipisci asperiores nemo, nobis quam, culpa provident numquam eius, beatae voluptatum magnam vel itaque? Accusamus, assumenda?</p>
                        <span>2</span>
                    </div>
                    <div class="detail">
                        <img src="image/return.png">
                        <h2>best return policy</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, at? Sed vero eos molestias adipisci asperiores nemo, nobis quam, culpa provident numquam eius, beatae voluptatum magnam vel itaque? Accusamus, assumenda?</p>
                        <span>3</span>
                    </div>
                    <div class="detail">
                        <img src="image/support.png">
                        <h2>online support</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, at? Sed vero eos molestias adipisci asperiores nemo, nobis quam, culpa provident numquam eius, beatae voluptatum magnam vel itaque? Accusamus, assumenda?</p>
                        <span>4</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- testimonial section -->
    <div class="testimonial-container">
        <div class="heading">
            <h1>testimonial</h1>
            <img src="image/separator.png">
        </div>
        <div class="container">
            <div class="testimonial-item active">
                <i class="bx bxs-quote-right" id="quote"></i>
                <img src="image/ourteam.webp">
                <h1>sara smith</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos natus facilis aliquam laudantium? Enim nesciunt praesentium, sequi fuga at blanditiis voluptatem aut voluptatibus a laborum ipsam voluptas quaerat sapiente harum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel expedita, pariatur neque consequuntur animi fugit mollitia quas, provident reprehenderit reiciendis sed laudantium incidunt modi, veniam ducimus alias laboriosam dignissimos rem.</p>
            </div>
            <div class="testimonial-item">
                <i class="bx bxs-quote-right" id="quote"></i>
                <img src="image/ourteam0.webp">
                <h1>john smith</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos natus facilis aliquam laudantium? Enim nesciunt praesentium, sequi fuga at blanditiis voluptatem aut voluptatibus a laborum ipsam voluptas quaerat sapiente harum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel expedita, pariatur neque consequuntur animi fugit mollitia quas, provident reprehenderit reiciendis sed laudantium incidunt modi, veniam ducimus alias laboriosam dignissimos rem.</p>
            </div>
            <div class="testimonial-item">
                <i class="bx bxs-quote-right" id="quote"></i>
                <img src="image/ourteam1.webp">
                <h1>selena ansari</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos natus facilis aliquam laudantium? Enim nesciunt praesentium, sequi fuga at blanditiis voluptatem aut voluptatibus a laborum ipsam voluptas quaerat sapiente harum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel expedita, pariatur neque consequuntur animi fugit mollitia quas, provident reprehenderit reiciendis sed laudantium incidunt modi, veniam ducimus alias laboriosam dignissimos rem.</p>
            </div>
            <div class="testimonial-item">
                <i class="bx bxs-quote-right" id="quote"></i>
                <img src="image/ourteam2.webp">
                <h1>alweena ansari</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos natus facilis aliquam laudantium? Enim nesciunt praesentium, sequi fuga at blanditiis voluptatem aut voluptatibus a laborum ipsam voluptas quaerat sapiente harum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel expedita, pariatur neque consequuntur animi fugit mollitia quas, provident reprehenderit reiciendis sed laudantium incidunt modi, veniam ducimus alias laboriosam dignissimos rem.</p>
            </div>
            <div class="left-arrow" onclick="leftSlide()"><i class="bx bx-left-arrow-alt"></i></div>
            <div class="right-arrow" onclick="rightSlide()"><i class="bx bx-right-arrow-alt"></i></div>
        </div>
    </div>

    <!-- our mission section -->
    <div class="mission">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>our mission</span>
                    <h1>share the authentic passion for sweets through our alfajores</h1>
                    <img src="image/separator.png">
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/sweet.png">
                    </div>
                    <div>
                        <h2>freshly baked</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni optio similique reprehenderit. Quidem delectus eaque laboriosam velit eligendi mollitia vitae facilis quis perspiciatis, nisi quod beatae voluptatum ut nam eius?</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/delivery.png">
                    </div>
                    <div>
                        <h2>delivery in 24 hours</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni optio similique reprehenderit. Quidem delectus eaque laboriosam velit eligendi mollitia vitae facilis quis perspiciatis, nisi quod beatae voluptatum ut nam eius?</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/app.png">
                    </div>
                    <div>
                        <h2>order online</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni optio similique reprehenderit. Quidem delectus eaque laboriosam velit eligendi mollitia vitae facilis quis perspiciatis, nisi quod beatae voluptatum ut nam eius?</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/support.png">
                    </div>
                    <div>
                        <h2>24/7 support</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni optio similique reprehenderit. Quidem delectus eaque laboriosam velit eligendi mollitia vitae facilis quis perspiciatis, nisi quod beatae voluptatum ut nam eius?</p>
                    </div>
                </div>
            </div>
            <div class="box-img">
                <img src="image/mission-r.avif" class="img" >
                <img src="image/mission-r0.jpg" class="img0" >
            </div>
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