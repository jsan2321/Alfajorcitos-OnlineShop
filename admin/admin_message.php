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

  //delete message from database

  if (isset($_POST['delete'])) {

    $delete_id = $_POST['delete'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $verify_delete = $conn->prepare("PREPARE * FROM `message` WHRE id = ? ");
    $verify_delete->execute([$delete_id]);

    if($verify_delete->rowCount() > 0) {
        $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
        $delete_message->execute([$delete_id]);

        $success_msg[] = 'message deleted';
    } else {
        $warning_msg[] = 'message already deleted';
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
      <title>Alfajorcitos - alfajores web site user messages page</title>
  </head>
  <body>

    <?php include '../components/admin_header.php'?>
    <div class="banner">
      <div class="detail">
        <h1>user messages</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi tenetur aut repudiandae libero dolore, delectus error sit repellendus assumenda possimus vitae unde quis quas sapiente reiciendis earum in dignissimos distinctio.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>user message</span>
      </div>
    </div>

    <section class="message-container">
        <div class="heading">
            <h1>user message's</h1>
            <img src="../image/separator.png">
        </div>
        <div class="box-container"> <!--"box-container" lo quita del centro-->
            <?php
                $select_message = $conn->prepare("SELECT * FROM `message`");
                $select_message->execute();

                if( $select_message->rowCount() > 0) {
                    while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="box">
                <h3 class="name"><?= $fetch_message['name']; ?></h3>
                <h4><?= $fetch_message['subject']; ?></h4>
                <p><?= $fetch_message['message']; ?></p>
                <form action="" method="post" >
                    <input type="hidden" name="delete_id" value="<? $fetch_message['id']; ?>" >
                    <button type="submit" name="delete" class="btn" onclick="return confirm('delete this message');" >delete message</button>
                </form>
            </div>
            <?php
                    }
                } else {
                    echo '
                        <div class="empty" style="margin: 2rem auto;" >
                            <p>no message</p>
                        </div>
                   ';
                }
            ?>

        </div>
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
