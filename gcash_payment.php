<?php
include 'components/connect.php';  // Include the database connection file
session_start();  // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');  // Redirect to home if not logged in
    exit();
}

// Initialize message variable
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_gcash'])) {
    // Get and sanitize form data
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $number = htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
    $total_products = htmlspecialchars($_POST['total_products'], ENT_QUOTES, 'UTF-8');
    $total_price = htmlspecialchars($_POST['total_price'], ENT_QUOTES, 'UTF-8');
    $reference_number = htmlspecialchars($_POST['reference_number'], ENT_QUOTES, 'UTF-8');
    $account_number = htmlspecialchars($_POST['account_number'], ENT_QUOTES, 'UTF-8');
    $account_name = htmlspecialchars($_POST['account_name'], ENT_QUOTES, 'UTF-8');
    $amount_paid = htmlspecialchars($_POST['amount_paid'], ENT_QUOTES, 'UTF-8');
    $method = 'gcash';

    // Ensure reference number and amount paid are not empty
    if(empty($reference_number)) {
        $message = 'Reference number is required.';
    } elseif(empty($amount_paid) || $amount_paid < $total_price) {
        $message = 'Insufficient amount paid.';
    } else {
        try {
            // Insert order into the database
            $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price, reference_number, account_number, account_name, amount_paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price, $reference_number, $account_number, $account_name, $amount_paid]);

            // Delete cart items
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);
            header('Location: orders.php');
            
        } catch (PDOException $e) {
            $message = 'Error: ' . $e->getMessage();
        }
    }
} else {
    // Retrieve checkout data from the session
    if (isset($_SESSION['checkout_data'])) {
        $name = $_SESSION['checkout_data']['name'];
        $number = $_SESSION['checkout_data']['number'];
        $email = $_SESSION['checkout_data']['email'];
        $address = $_SESSION['checkout_data']['address'];
        $total_products = $_SESSION['checkout_data']['total_products'];
        $total_price = $_SESSION['checkout_data']['total_price'];
    } else {
        $name = '';
        $number = '';
        $email = '';
        $address = '';
        $total_products = '';
        $total_price = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gcash Payment</title>
    <style>
        .user-info { text-align: center; margin-top: 50px; }
        .box { display: block; margin: 10px auto; padding: 10px; width: 20%; }
        .btn { padding: 10px; cursor: pointer; }
        .var-red { background-color: red; width: 22%; }
        .var-white { color: white; }
    </style>
</head>
<body>
    <?php if (!empty($message)) { ?>
        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php } else { ?>
        <form action="" method="post" id="paymentForm">
            <div class="user-info">
                <h3>Gcash QR Code</h3>
                <p><img src="images/gcash.png" alt="Gcash QR Code"></p>
                <input type="hidden" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="number" value="<?= htmlspecialchars($number, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="address" value="<?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="total_products" value="<?= htmlspecialchars($total_products, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="total_price" id="totalPrice" value="<?= htmlspecialchars($total_price, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="text" name="reference_number" placeholder="Enter reference number" class="box" required>
                <input type="text" name="account_number" placeholder="Enter account number" class="box" required>
                <input type="text" name="account_name" placeholder="Enter account name" class="box" required>
                <input type="number" name="amount_paid" id="amountPaid" placeholder="Enter amount paid" class="box" required>
                <input type="submit" value="Confirm Payment" class="btn var-red var-white" name="submit_gcash" id="confirmPayment">
            </div>
        </form>
    <?php } ?>
</body>
</html>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const amountPaidInput = document.getElementById('amountPaid');
    const confirmPaymentButton = document.getElementById('confirmPayment');
    const totalPrice = parseFloat(document.getElementById('totalPrice').value);

    amountPaidInput.addEventListener('input', function () {
        const amountPaid = parseFloat(amountPaidInput.value);
        if (isNaN(amountPaid) || amountPaid < totalPrice) {
            confirmPaymentButton.disabled = true;
            confirmPaymentButton.value = 'Insufficient amount paid';
        } else {
            confirmPaymentButton.disabled = false;
            confirmPaymentButton.value = 'Confirm Payment';
        }
    });
});
</script>
