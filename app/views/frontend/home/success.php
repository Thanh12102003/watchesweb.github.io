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
                <h1 class="h3 font-weight-normal text-center">Checkout Thành Công</h1>
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <?php
                                if (isset($_GET['ordercode'])) {
                                    $ordercode = htmlspecialchars($_GET['ordercode']);
                                    echo "<h3>Thank you for your order!</h3>";
                                    echo "<p>Your order has been placed successfully. Your order code is: <strong>$ordercode</strong></p>";
                                } else {
                                    echo "<h3>Order not found</h3>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



        </div>

    </div>


</div>