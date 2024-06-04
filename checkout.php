<?php
include 'components/connect.php';  // Include the database connection file
session_start();  // Start the session

// Check if the user is logged in
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');  // Redirect to home if not logged in
   exit();
}

// Check if the form is submitted
if(isset($_POST['submit'])){
   // Get and sanitize form data
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);
   $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   // Check if the cart is not empty
   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){
      if($address == ''){
         $message[] = 'Please add your address!';
      }else{
         if ($method == 'cash on delivery') {
            // Insert order into the database for Cash on Delivery
            $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
            header('Location: orders.php');
            // Delete cart items
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);

            $message[] = 'Order placed successfully!';
         } else if ($method == 'gcash') {
            // Store checkout data in session and redirect to gcash_payment.php
            $_SESSION['checkout_data'] = [
               'name' => $name,
               'number' => $number,
               'email' => $email,
               'address' => $address,
               'total_products' => $total_products,
               'total_price' => $total_price
            ];
            header('Location: gcash_payment.php');
            exit();
         }
      }
   }else{
      $message[] = 'Your cart is empty';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <!-- Font Awesome CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Include header -->
<?php include 'components/user_header.php'; ?>

<div class="heading">
   <h3>Checkout</h3>
   <p><a href="home.php">Home</a> <span> / Checkout</span></p>
</div>

<section class="checkout">
   <h1 class="title">Order Summary</h1>

   <form id="checkout-form" action="" method="post">
      <div class="cart-items">
         <h3>Cart Items</h3>
         <?php
         $grand_total = 0;
         $cart_items = [];
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
               ?>
               <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price">₱<?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
               <?php
            }
         }else{
            echo '<p class="empty">Your cart is empty!</p>';
         }
         ?>
         <p class="grand-total"><span class="name">Grand Total :</span><span class="price">₱<?= $grand_total; ?></span></p>
         <a href="cart.php" class="btn">View Cart</a>
      </div>

      <input type="hidden" name="total_products" value="<?= $total_products; ?>">
      <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
      <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
      <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
      <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
      <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

      <div class="user-info">
         <h3>Your Info</h3>
         <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
         <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
         <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
         <a href="update_profile.php" class="btn">Update Info</a>
         <h3>Delivery Address</h3>
         <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'Please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
         <a href="update_address.php" class="btn">Update Address</a>
         <select name="method" class="box" required>
            <option value="" disabled selected>Select Payment Method --</option>
            <option value="cash on delivery">Cash on Delivery</option>
            <option value="gcash">Gcash</option>
         </select>
         <input type="submit" value="Confirm" class="btn <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
      </div>
   </form>
</section>

<!-- Include footer -->
<?php include 'components/footer.php'; ?>

<!-- Custom JS -->
<script src="js/script.js"></script>

</body>
</html>
