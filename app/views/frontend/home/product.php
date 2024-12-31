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
                <div class="row">
                    <div class="col-md-4">
                        <!-- Product Card -->
                        <div class="card">
                            <img src="<?= BASE_URL  . 'uploads/products/' . htmlspecialchars($product['image']) ?>" class="card-img-top" alt="Product Image" style="height: 500px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text"><?php echo $product['description']; ?></p>
                            <div class="d-flex justify-content-between">
                                <span class="badge bg-success">$<?php echo number_format($product['price'], 2); ?></span>
                                <form method="POST" action="<?= BASE_URL ?>frontend/home/addToCart/<?= $product['id']; ?>">
                                    <input type="submit" class="btn btn-success" value="Add to Cart">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Related Products</h5>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($related as $product_re): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?= BASE_URL  . 'uploads/products/' . htmlspecialchars($product_re['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product_re['name']); ?>" style="height: 100px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($product_re['name']); ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($product_re['description']); ?></p>
                                    <p class="card-text"><strong>Price:</strong> <?= htmlspecialchars($product_re['price']); ?> VND</p>
                                    <a href="<?= BASE_URL ?>frontend/home/product/<?= $product_re['id']; ?>" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>

    </div>


</div>