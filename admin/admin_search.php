<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

// Initialize message array
$message = [];

// Check if the search query is submitted
if(isset($_GET['search_query'])){
   $search_query = $_GET['search_query'];
   
   // Query to search for the user based on name or ID
   $search_user_query = $conn->prepare("SELECT * FROM `users` WHERE id = ? OR name LIKE ?");
   $search_user_query->execute([$search_query, '%' . $search_query . '%']);

   // Fetch user information if found
   if($user = $search_user_query->fetch(PDO::FETCH_ASSOC)){
      $user_id = $user['id'];

      // Query to fetch order summary based on user ID
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);

      // Display user information and order summary
      
      echo '<h2>User Information:</h2>';
      echo '<p>User ID: ' . $user['id'] . '</p>';
      echo '<p>Name: ' . $user['name'] . '</p>';
      echo '<p>Email: ' . $user['email'] . '</p>';
      echo '<h2>Order Summary:</h2>';
      if($select_orders->rowCount() > 0){
         while($order = $select_orders->fetch(PDO::FETCH_ASSOC)){
            echo '<div class="box">';
            echo '<p>User ID: ' . $order['user_id'] . '</p>';
            echo '<p>Placed On: ' . $order['placed_on'] . '</p>';
            echo '<p>Name: ' . $order['name'] . '</p>';
            echo '<p>Email: ' . $order['email'] . '</p>';
            echo '<p>Number: ' . $order['number'] . '</p>';
            echo '<p>Address: ' . $order['address'] . '</p>';
            echo '<p>Total Products: ' . $order['total_products'] . '</p>';
            echo '<p>Total Price: ₱' . $order['total_price'] . '</p>';
            echo '<p>Payment Method: ' . $order['method'] . '</p>';
            echo '</div>';
         }
      }else{
         echo '<p>No orders found for this user.</p>';
      }
   }else{
      echo '<p>User not found.</p>';
   }
}
?>