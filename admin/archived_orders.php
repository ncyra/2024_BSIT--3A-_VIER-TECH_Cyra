<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Archived Orders</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="archived-orders">
   <h1 class="heading">Archived Orders</h1>
   <div class="box-container">
   <?php
      $select_archived_orders = $conn->prepare("SELECT * FROM `orders` WHERE archived = 1");
      $select_archived_orders->execute();
      if($select_archived_orders->rowCount() > 0){
         while($fetch_archived_orders = $select_archived_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_archived_orders['user_id']; ?></span> </p>
      <p> placed on : <span><?= $fetch_archived_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_archived_orders['name']; ?></span> </p>
      <p> email : <span><?= $fetch_archived_orders['email']; ?></span> </p>
      <p> number : <span><?= $fetch_archived_orders['number']; ?></span> </p>
      <p> address : <span><?= $fetch_archived_orders['address']; ?></span> </p>
      <p> total products : <span><?= $fetch_archived_orders['total_products']; ?></span> </p>
      <p> total price : <span>₱<?= $fetch_archived_orders['total_price']; ?></span> </p>
      <p> payment method : <span><?= $fetch_archived_orders['method']; ?></span> </p>
      <p> payment status : <span><?= $fetch_archived_orders['payment_status']; ?></span> </p>
      <p> order status : <span><?= $fetch_archived_orders['order_status']; ?></span> </p>
      <div class="flex-btn">
         <a href="placed_orders.php" class="btn">Back to Orders</a>
      </div>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No archived orders found!</p>';
      }
   ?>
   </div>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
