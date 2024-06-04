<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_reviews = $conn->prepare("DELETE FROM `reviews` WHERE id = ?");
   $delete_reviews->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- messages section starts  -->

<section class="messages">

   <h1 class="heading">messages</h1>

   <div class="box-container">

   <?php
      $select_reviews = $conn->prepare("SELECT * FROM `reviews`");
      $select_reviews->execute();
      if($select_reviews->rowCount() > 0){
         while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> name : <span><?= $fetch_reviews['name']; ?></span> </p>
      <p> email : <span><?= $fetch_reviews['email']; ?></span> </p>
      <p> reviews : <span><?= $fetch_reviews['reviews']; ?></span> </p>
      <a href="messages.php?delete=<?= $fetch_reviews['id']; ?>" class="delete-btn" onclick="return confirm('delete this reviews?');">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no reviews</p>';
      }
   ?>

   </div>

</section>

<!-- messages section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>