<?php

  error_reporting(E_ALL); // reports and logs all errors
  ini_set('display_errors', '1'); //  display the errors directly on the web page
  include 'components/connect.php';
  
  if(isset($_COOKIE['user_id'])) {
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
    <link rel="stylesheet" type="text/css" href="../css/user_style.css?v=<?php echo time(); ?>"> 
    <title>Alfajorcitos - alfajores web site home page</title>
  </head>

  <body>
    <?php include 'components/user_header.php'; ?>

    <!-- home slider section start -->
    <div class="slider-container">
      <div class="container">
        <div class="slider-item active">
          <img src="image/slider.jpg" alt="">
        </div>
        <div class="slider-item">
          <img src="image/slider.avif" alt="">
        </div>
        <div class="slider-item">
          <img src="image/slider0.avif" alt="">
        </div>
        <div class="slider-item">
          <img src="image/slider1.jpg" alt="">
        </div>
        <div class="slider-item">
          <img src="image/slider2.jpg" alt="">
        </div>
      </div>
      <div class="left-arrow" onclick="nextSlide()" ><i class="bx bx-left-arrow-alt" ></i></div>
      <div class="right-arrow" onclick="prevSlide()" ><i class="bx bx-right-arrow-alt" ></i></div>
    </div>
    <!-- home slider section end -->

    <!-- service section start -->
    <div class="services">
      <div class="box-container">
        <div class="box">
          <div class="icon">
            <img src="image/service.png" alt="Online Shopping Icon">
          </div>
          <div class="detail">
            <h4>delicious alfajores</h4>
            <span>handcrafted with love</span>
          </div>
        </div>
        <div class="box">
          <div class="icon">
            <img src="image/services2.png" alt="Quality Products Icon">
          </div>
          <div class="detail">
            <h4>premium ingredients</h4>
            <span>locally sourced</span>
          </div>
        </div>
        <div class="box">
          <div class="icon">
            <img src="image/services.png" alt="Delivery Icon">
          </div>
          <div class="detail">
            <h4>fast delivery</h4>
            <span>24/7 doorstep service</span>
          </div>
        </div>
        <div class="box">
          <div class="icon">
            <img src="image/services0.png" alt="Customer Services Icon">
          </div>
          <div class="detail">
            <h4>exceptional support</h4>
            <span>customer satisfaction guaranteed</span>
          </div>
        </div>
        <div class="box">
          <div class="icon">
            <img src="image/service.png" alt="Organized Icon">
          </div>
          <div class="detail">
            <h4>organic goodness</h4>
            <span>free returns, always</span>
          </div>
        </div>
        <div class="box">
          <div class="icon">
            <img src="image/services1.png" alt="More Icon">
          </div>
          <div class="detail">
            <h4>explore variety</h4>
            <span>Eedless options to indulge in</span>
          </div>
        </div>
      </div>
    </div>
    <!-- service section end -->

    <!-- frame section starts -->
    <img src="image/sub-banner0.jpg" class="sub-banner">

    <div class="frame-container">
      <div class="box-container">
        <div class="frame">
          <div class="detail">
            <span>special treats</span>
            <h2>50% Off</h2>
            <h1>all alfajores</h1>
            <a class="btn" >shop now</a>
          </div>
        </div>
        <div class="box">
          <div class="box-detail">
            <img src="image/frame.avif" class="img" >
            <div class="img-detail">
              <span>wide selection</span>
              <h1>classic flavors</h1>
              <a class="btn" >shop now</a>
            </div>
          </div>
          <div class="box-detail">
            <img src="image/frame2.webp" class="img" >
            <div class="img-detail">
              <span>artisanal touch</span>
              <h1>specialty flavors</h1>
              <a class="btn" >shop now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- frame section ends -->

    <!-- about section start -->
    <div class="about-us">
      <div class="box-container">
        <div class="img-box">
          <img src="image/about.jpg" class="img" >
          <img src="image/about0.jpg" class="img1" >
          <div class="play"><i class="bx bx-play" ></i></div>
        </div>
        <div class="box">
          <div class="heading">
            <span>why choose us</span>
            <h1>why alfajorcitos</h1>
            <img src="image/separator.png" >
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam rem, provident aliquid consectetur quas tempore soluta quo dolor nam aperiam fuga, assumenda molestiae eaque quibusdam, totam eum doloremque dicta. Ea!</p>
            <a href="about-us.php" class="btn" >know more</a>
            <a href="contact.php" class="btn" >contact us</a>
          </div>
        </div>
      </div>
    </div>
    <!-- about section ends -->

    <!-- sub-banner section starts -->
    <div class="sub-banner">
      <div class="box-container">
        <img src="image/sub-banner.png" >
        <img src="image/sub-banner.jpg" height="85%" >
      </div>
    </div>
    <!-- sub-banner section end -->

    <!-- categories section starts -->
    <div class="categories">
      <div class="heading">
        <h1>explore our flavors</h1>
        <img src="image/separator.png" >
      </div> 
      <div class="box-container">
        <div class="box">
          <img src="image/features4.avif" >
          <div class="detail">
            <span>seasonal specials</span>
            <h1>summer fruit deligths</h1>
            <a href="shop.php" class="btn" >shop now</a>
          </div>
        </div>
        <div class="box">
          <img src="image/features2.avif" >
          <div class="detail">
            <span>healthier choices</span>
            <h1>gluten-free alfajores</h1>
            <a href="shop.php" class="btn" >shop now</a>
          </div>
        </div>
        <div class="box">
          <img src="image/features0.jpg" >
          <div class="detail">
            <span>regional delights</span>
            <h1>patagonia chocolate alfajores</h1>
            <a href="shop.php" class="btn" >shop now</a>
          </div>
        </div>
        <div class="box">
          <img src="image/features3.avif" >
          <div class="detail">
            <span>customized gifts</span>
            <h1>we'll make it  for you</h1>
            <a href="shop.php" class="btn" >shop now</a>
          </div>
        </div>
      </div>
    </div>
    <!-- categories section starts -->

    <!-- sub-banner section starts -->
    <div class="sub-banner">
      <div class="box-container">
        <img src="image/sub-banner2.avif" >
        <img src="image/sub-banner3.avif" >
      </div>
    </div>
    <!-- sub-banner section end -->

    <?php include 'components/user_footer.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- custom js link  -->
    <script type="text/javascript" src="../js/user_script.js"></script>
    <!-- alert -->
    <?php include 'components/alert.php'; ?>
  </body>

</html>