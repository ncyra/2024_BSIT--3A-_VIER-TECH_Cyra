<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');
    exit();
}

if (isset($_POST['delete'])) {
    $cart_id = $_POST['cart_id'];

    // Restore the stock quantity
    $select_cart_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
    $select_cart_item->execute([$cart_id]);
    $cart_item = $select_cart_item->fetch(PDO::FETCH_ASSOC);
    $pid = $cart_item['pid'];
    $quantity = $cart_item['quantity'];

    $restore_stock = $conn->prepare("UPDATE `products` SET stocks = stocks + ? WHERE id = ?");
    $restore_stock->execute([$quantity, $pid]);

    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$cart_id]);
    $message[] = 'Cart item deleted!';
}

if (isset($_POST['delete_all'])) {
    // Restore the stock quantity for all items in the cart
    $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $select_cart_items->execute([$user_id]);

    while ($cart_item = $select_cart_items->fetch(PDO::FETCH_ASSOC)) {
        $pid = $cart_item['pid'];
        $quantity = $cart_item['quantity'];
        $restore_stock = $conn->prepare("UPDATE `products` SET stocks = stocks + ? WHERE id = ?");
        $restore_stock->execute([$quantity, $pid]);
    }

    $delete_cart_items = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_items->execute([$user_id]);
    $message[] = 'Deleted all from cart!';
}

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $new_qty = $_POST['qty'];
    $new_qty = filter_var($new_qty, FILTER_SANITIZE_STRING);

    // Fetch the current quantity and stock details
    $select_cart_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
    $select_cart_item->execute([$cart_id]);
    $cart_item = $select_cart_item->fetch(PDO::FETCH_ASSOC);
    $pid = $cart_item['pid'];
    $current_qty = $cart_item['quantity'];

    // Update the stock based on the new quantity
    if ($new_qty > $current_qty) {
        $qty_diff = $new_qty - $current_qty;
        $update_stock = $conn->prepare("UPDATE `products` SET stocks = stocks - ? WHERE id = ?");
        $update_stock->execute([$qty_diff, $pid]);
    } else {
        $qty_diff = $current_qty - $new_qty;
        $update_stock = $conn->prepare("UPDATE `products` SET stocks = stocks + ? WHERE id = ?");
        $update_stock->execute([$qty_diff, $pid]);
    }

    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->execute([$new_qty, $cart_id]);
    $message[] = 'Cart quantity updated';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

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
    <h3>shopping cart</h3>
    <p><a href="home.php">home</a> <span> / cart</span></p>
</div>

<!-- shopping cart section starts  -->

<section class="products">

    <h1 class="title">your cart</h1>

    <div class="box-container">

        <?php
        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $select_cart->execute([$user_id]);
        if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                $grand_total += $sub_total;
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
            <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
            <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('delete this item?');"></button>
            <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
            <div class="name"><?= $fetch_cart['name']; ?></div>
            <div class="flex">
                <div class="price"><span>₱</span><?= $fetch_cart['price']; ?></div>
                <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                <button type="submit" class="fas fa-edit" name="update_qty"></button>
            </div>
            <div class="sub-total"> sub total : <span>₱<?= $sub_total; ?></span> </div>
        </form>
        <?php
            }
        } else {
            echo '<p class="empty">your cart is empty</p>';
        }
        ?>

    </div>

    <div class="cart-total">
        <p>cart total : <span>₱<?= $grand_total; ?></span></p>
        <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
    </div>

    <div class="more-btn">
        <form action="" method="post">
            <button type="submit" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm('delete all from cart?');">delete all</button>
        </form>
        <a href="menu.php" class="btn">continue shopping</a>
    </div>

</section>

<!-- shopping cart section ends -->

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
