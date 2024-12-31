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
            <div class="col-md-12">
                <h1 class="h3 font-weight-normal text-center"><?= htmlspecialchars($title); ?></h1>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($all_product as $product): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?= BASE_URL  . 'uploads/products/' . htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>" style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($product['description']); ?></p>
                                    <p class="card-text"><strong>Price:</strong> <?= htmlspecialchars($product['price']); ?> VND</p>
                                    <a href="<?= BASE_URL ?>frontend/home/product/<?= $product['id']; ?>" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>


        </div>

    </div>


</div>