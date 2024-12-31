<style>
    .card_main {
        margin: 0 auto;
        display: block;
    }
</style>
<div class="card card_main" style="width: 100%">

    <div class="card-body ">
        <div class="row">
            <?php include('includes/nav_logo.php') ?>
            <div class="container mt-4">
                <h2>Order Details - <?= htmlspecialchars($order['ordercode']); ?></h2>

                <!-- Display Status -->
                <p><strong>Status:</strong>
                    <?php if ($order['status'] == 1): ?>
                        <span class="badge bg-primary">Đơn hàng mới</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Đơn hàng đã được xử lý</span>
                    <?php endif; ?>
                </p>
                <p><strong>Order Date:</strong> <?= date('Y-m-d H:i:s', strtotime($order['created_at'])); ?></p>

                <h4>Cart Items:</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Decode the cart items stored in JSON format
                        $cartItems = json_decode($order['cart_items'], true);
                        foreach ($cartItems as $item): ?>
                            <tr>
                                <td>
                                    <!-- Display product image -->
                                    <img src="<?= BASE_URL  . 'uploads/products/' . htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']); ?>" width="50" height="50" style="object-fit: cover;">
                                </td>
                                <td><?= htmlspecialchars($item['name']); ?></td>
                                <td><?= htmlspecialchars($item['quantity']); ?></td>
                                <td>$<?= number_format($item['price'], 2); ?></td>
                                <td>$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>


</div>