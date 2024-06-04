<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

$messages = []; // Define an array to store messages

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $reviews = $_POST['reviews'];
   $reviews = filter_var($reviews, FILTER_SANITIZE_STRING);

   $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE name = ? AND email = ? AND reviews = ?");
   $select_reviews->execute([$name, $email, $reviews]);

   if($select_reviews->rowCount() > 0){
      $messages[] = 'already sent reviews!';
   }else{
      $insert_reviews = $conn->prepare("INSERT INTO `reviews`(user_id, name, email, reviews) VALUES(?,?,?,?)");
      $insert_reviews->execute([$user_id, $name, $email, $reviews]);
      $messages[] = 'sent reviews successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Reviews</h3>
   <p><a href="home.php">home</a> <span> / reviews</span></p>
</div>

<!-- contact section starts  -->

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/support.png" alt="">
      </div>

      <form action="" method="post">
         <h3>tell us something!</h3>
         <input type="text" name="name" maxlength="50" class="box" placeholder="enter your name" required>
         <input type="email" name="email" maxlength="50" class="box" placeholder="enter your email" required>
         <textarea name="reviews" class="box" required placeholder="write your comment here!" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="Submit" name="send" class="btn">
      </form>

   </div>

</section>

<!-- contact section ends -->

<?php
if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<p>$message</p>";
    }
}
?>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
