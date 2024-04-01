<?php

error_reporting(E_ALL); // reports and logs all errors
ini_set('display_errors', '1'); //  display the errors directly on the web page
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
  $seller_id = $_COOKIE['seller_id'];
} else {
  $seller_id = '';
  header('location:login.php');
}

if (isset($_POST['update'])) {  
    $select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE id=? LIMIT 1");
    $select_seller->execute([$seller_id]);
    $fetch_seller = $select_seller->fetch(PDO::FETCH_ASSOC);

    $prev_pass = $fetch_seller['password'];
    $prev_image = $fetch_seller['image'];
    
    $name = $_POST['name'];
    // $name = filter_var($name, FILTER_SANITIZE_STRING);
    $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // update user name
    if (!empty($name)) {
        $update_name = $conn->prepare("UPDATE `sellers` SET name = ? WHERE id = ?");
        $update_name->execute([$name, $seller_id]);
        $success_msg[] = 'username updated successfully'; 
    }

    //update user email address
    if (!empty($email)) {
        $select_email = $conn->prepare("SELECT email FROM `sellers` WHERE id = ? AND email = ?");
        $select_email->execute([$seller_id, $email]);

        if($select_email->rowCount() > 0) {
            $warning_msg[] = 'email already taken!';
        } else{
            $update_email = $conn->prepare("UPDATE `sellers` SET email = ? WHERE id = ?");
            $update_email->execute([$email, $seller_id]);
            $success_msg[] = 'email updated successfully';
        }
    }

    // update profile
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
        $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $ext = pathinfo($image, PATHINFO_EXTENSION);
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;

        if($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        } else {
            $update_image = $conn->prepare("UPDATE `sellers` SET `image` = ? WHERE id = ?");
            $update_image->execute([$rename, $seller_id]);
            move_uploaded_file($image_tmp_name, $image_folder);

            if ($prev_image != '' AND $prev_image != $rename) {
                unlink(('../uploaded_files/'.$prev_image));
            }
            $success_msg[] = 'image updated successfully';
        }
    }

    // update password
    $empty_pass = 'dea39a3ee5e6b40d3255bfef95601890afd08709';
    $old_pass = sha1($_POST['old_pass']);
    $new_pass = sha1($_POST['new_pass']);
    $cpass = sha1($_POST['cpass']);

    if ($old_pass != $empty_pass) {
        if ($old_pass != $prev_pass) {
            $warning_msg[] = 'old password not matched';
        } elseif ($new_pass != $cpass) {
            $warning_msg[] = 'confirm password not matched';
        } else {
            if ($new_pass != $empty_pass) {
                $update_pass = $conn->prepare("UPDATE `sellers` SET password = ? WHERE id = ?");
                $update_pass->execute([$cpass, $seller_id]);
                $success_msg[] = 'password updated successfully';
            } else {
                $warning_msg[] = 'please enter a new password';
            }
        }
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
      <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>" > <!-- appending a query parameter to the URL, which includes the current timestamp -->
      <title>Alfajorcitos - alfajores web site update profile page</title>
  </head>
  <body>

    <?php include '../components/admin_header.php'?>
    <div class="banner">
      <div class="detail">
        <h1>update profile</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>update profile</span>
      </div>
    </div>

    <div class="heading">
        <h1>update profile</h1>
        <img src="../image/separator.png" width="100">
    </div>

    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register"> <!-- couldnt upload image file beacuse of typo in enctype attribute -->
            <div class="img-box">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
            </div>
            <h3>update profile</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>your name</p>
                        <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>your email</p>
                        <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>update profile</p>
                        <input type="file" name="image" accept="image/*" class="box">
                    </div>
                </div>
                <div class="col">
                    <div class="input-field">
                        <p>old password</p>
                        <input type="password" name="old_pass" placeholder="enter your old password" class="box">
                    </div>
                    <div class="input-field">
                        <p>new password</p>
                        <input type="password" name="new_pass" placeholder="enter your new password" class="box">
                    </div>
                    <div class="input-field">
                        <p>confirm password</p>
                        <input type="password" name="cpass" placeholder="confirm password" class="box">
                    </div>
                </div>
            </div>
            <input type="submit" name="update" class="btn" value="update profile">
        </form>
    </section>

    <?php include '../components/admin_footer.php'?>

    <!-- sweetalert cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- custom js link  -->
    <script type="text/javascript" src="../js/admin_scripts.js"></script>
    <!-- alert -->
    <?php include '../components/alert.php' ?>

  </body>
</html>