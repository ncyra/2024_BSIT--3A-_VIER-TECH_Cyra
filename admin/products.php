<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit();
}

if (isset($_POST['add_product'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
    $stocks = filter_var($_POST['stocks'], FILTER_SANITIZE_NUMBER_INT);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'Product name already exists!';
    } else {
        if ($image_size > 2000000) {
            $message[] = 'Image size is too large';
        } elseif (!in_array($image_extension, $allowed_extensions)) {
            $message[] = 'Invalid image format';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);

            $insert_product = $conn->prepare("INSERT INTO `products` (name, category, price, image, stocks) VALUES (?, ?, ?, ?, ?)");
            $insert_product->execute([$name, $category, $price, $image, $stocks]);

            $message[] = 'New product added!';
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded_img/' . $fetch_delete_image['image']);

    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$delete_id]);

    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);

    header('location:products.php');
    exit();
}

if (isset($_POST['purchase_product'])) {
    $pid = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);

    $get_stock = $conn->prepare("SELECT stocks FROM `products` WHERE id = ?");
    $get_stock->execute([$pid]);
    $current_stock = $get_stock->fetchColumn();

    if ($quantity > $current_stock) {
        $message[] = 'Not enough stock available';
    } else {
        $new_stock = $current_stock - $quantity;

        $update_stock = $conn->prepare("UPDATE `products` SET stocks = ? WHERE id = ?");
        $update_stock->execute([$new_stock, $pid]);

        $message[] = 'Purchase successful';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- Add Products Section -->
<section class="add-products">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>Add Product</h3>
        <input type="text" required placeholder="Enter product name" name="name" maxlength="100" class="box">
        <input type="number" min="0" max="9999999999" required placeholder="Enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
        <select name="category" class="box" required>
            <option value="" disabled selected>Select category --</option>
            <option value="Fruits">Fruits</option>
            <option value="Vegetables">Vegetables</option>
            <option value="Beverages">Beverages</option>
            <option value="Snacks">Snacks</option>
        </select>
        <input type="number" min="0" required placeholder="Enter stock quantity" name="stocks" class="box">
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
        <input type="submit" value="Add Product" name="add_product" class="btn">
    </form>
</section>

<!-- Show Products Section -->
<section class="show-products" style="padding-top: 0;">
    <div class="box-container">
        <?php
        $show_products = $conn->prepare("SELECT * FROM `products`");
        $show_products->execute();
        if ($show_products->rowCount() > 0) {
            while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <div class="box">
                    <img src="../uploaded_img/<?= htmlspecialchars($fetch_products['image']); ?>" alt="">
                    <div class="flex">
                        <div class="price"><span>₱</span><?= htmlspecialchars($fetch_products['price']); ?><span></span></div>
                        <div class="category"><?= htmlspecialchars($fetch_products['category']); ?></div>
                    </div>
                    <div class="name"><?= htmlspecialchars($fetch_products['name']); ?></div>
                    <div class="stocks">Stocks: <?= htmlspecialchars($fetch_products['stocks']); ?></div>
                    <div class="flex-btn">
                        <a href="update_product.php?update=<?= htmlspecialchars($fetch_products['id']); ?>" class="option-btn">Update</a>
                        <a href="products.php?delete=<?= htmlspecialchars($fetch_products['id']); ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
                    </div>
                    <form action="" method="POST" class="purchase-form">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($fetch_products['id']); ?>">
                        <input type="number" name="quantity" min="1" max="<?= htmlspecialchars($fetch_products['stocks']); ?>" placeholder="Quantity" required>
                        <input type="submit" name="purchase_product" value="Purchase" class="btn">
                    </form>
                </div>
        <?php
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>
    </div>
</section>

<!-- custom js file link -->
<script src="../js/admin_script.js"></script>

</body>
</html>
