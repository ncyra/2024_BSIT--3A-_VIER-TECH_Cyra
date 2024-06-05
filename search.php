<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Page</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Header Section Starts -->
<?php include 'components/user_header.php'; ?>
<!-- Header Section Ends -->

<!-- Search Form Section Starts -->
<section class="search-form">
   <form method="post" action="">
      <input type="text" name="search_box" placeholder="Search here..." class="box" required>
      <button type="submit" name="search_btn" class="fas fa-search"></button>
   </form>
</section>
<!-- Search Form Section Ends -->

<!-- Products Section Starts -->
<section class="products" style="min-height: 100vh; padding-top:0;">
<div class="box-container">

   <?php
   if(isset($_POST['search_box']) || isset($_POST['search_btn'])){
      $search_box = htmlspecialchars($_POST['search_box']);
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ? OR description LIKE ? OR category LIKE ?");
      $select_products->execute(['%' . $search_box . '%', '%' . $search_box . '%', '%' . $search_box . '%']);
      
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="description"><?= $fetch_products['description']; ?></div>
      <div class="category">Category: <?= $fetch_products['category']; ?></div>
      <div class="flex">
         <div class="price"><span>₱</span><?= $fetch_products['price']; ?></div>
         <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
      </div>
   </form>
   <?php
         }
      }else{
         // If no products found, display relevant items based on categorie
         $related_products = $conn->prepare("SELECT * FROM `products` WHERE category IN (SELECT category FROM `products` WHERE name LIKE ? OR description LIKE ?) ORDER BY RAND() LIMIT 6");
         $related_products->execute(['%' . $search_box . '%', '%' . $search_box . '%']);
         if($related_products->rowCount() > 0){
            while($fetch_related = $related_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_related['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_related['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_related['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_related['image']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_related['id']; ?>" class="fas fa-eye"></a>
      <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
      <img src="uploaded_img/<?= $fetch_related['image']; ?>" alt="">
      <div class="name"><?= $fetch_related['name']; ?></div>
      <div class="description"><?= $fetch_related['description']; ?></div>
      <div class="category">Category: <?= $fetch_related['category']; ?></div>
      <div class="flex">
         <div class="price"><span>₱</span><?= $fetch_related['price']; ?></div>
         <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
      </div>
   </form>
   <?php
            }
         } else {
            echo '<p class="empty">No relevant items found!</p>';
         }
      }
   }
   ?>

</div>
</section>
<!-- Products Section Ends -->

<!-- Footer Section Starts -->
<?php include 'components/footer.php'; ?>
<!-- Footer Section Ends -->

<!-- Custom JS File Link -->
<script src="js/script.js"></script>

</body>
</html>
