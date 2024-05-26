<?php 
include './components/header.php';
include './components/navbar.php';

$prod_id = isset($_GET['prod_id']) ? $_GET['prod_id'] : null;

if ($prod_id) {
    $stmt = $conn->prepare("
        SELECT p.prod_id, p.prod_name, p.description, p.price, p.stocks, c.category_name
        FROM products p
        INNER JOIN category c ON p.category_id = c.category_id
        WHERE p.prod_id = :prod_id
    ");
    $stmt->bindParam(':prod_id', $prod_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt_images = $conn->prepare("
        SELECT img_directory 
        FROM product_images 
        WHERE prod_id = :prod_id
    ");
    $stmt_images->bindParam(':prod_id', $prod_id);
    $stmt_images->execute();
    $images = $stmt_images->fetchAll(PDO::FETCH_ASSOC);

} else {
    echo '<p>No product ID specified.</p>';
}
?>

<body>
    <form action="" method="post">
        <div class="product-container container w-full flex justify-center md:flex-col mx-auto px-4 md:px-8 py-8">
            <div class="img-products px-4 order-1 md:order-none">
                <div class="overflow-hidden easyzoom">
                    <?php if (!empty($images)) { ?>
                    <img class=" w-full h-96 object-cover rounded-t-lg" src="<?php echo $images[0]['img_directory']; ?>"
                        alt="Product Image">
                    <?php } else { ?>
                    <img class="w-full h-96 object-cover rounded-t-lg" src="../images/placeholder.svg"
                        alt="Product Image">
                    <?php } ?>
                    <div class="grid grid-cols-5 mt-7 gap-4 order-none md:order-1 overflow-x-auto">
                        <?php foreach ($images as $image) { ?>
                        <div>
                            <img class="cursor-pointer w-full rounded-lg object-cover" style="height: 130px;"
                                src="<?php echo $image['img_directory']; ?>" alt="Product Image">
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="px-5 pb-5 mt-6 md:mt-0">
                <a href="#">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        <?php echo $product['prod_name']?>
                    </h5>
                </a>
                <div class="flex items-center mt-2.5 mb-5">
                    <div class="flex items-center space-x-1 rtl:space-x-reverse">
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                    </div>
                    <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded ms-3">5.0</span>
                </div>
                <span class="text-3xl font-bold text-gray-900 dark:text-white">₱<?php echo $product['price']; ?></span>
                <div class="mx-auto mt-5">
                    <label for="bedrooms-input"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose quantity:</label>
                    <div class="relative flex items-center max-w-[8rem]">
                        <button type="button" id="decrement-button" data-input-counter-decrement="bedrooms-input"
                            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 1h16" />
                            </svg>
                        </button>
                        <input type="text" id="bedrooms-input" data-input-counter data-input-counter-min="1"
                            data-input-counter-max="<?php echo $product['stocks']; ?>"
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="" value="1" required />
                        <button type="button" id="increment-button" data-input-counter-increment="bedrooms-input"
                            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>
                    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <?php echo $product['stocks']; ?> piece/s available</p>
                </div>


                <?php if (!isset($_SESSION['user_id'])) { ?>

                <div class="flex items-center justify-between mt-7
">
                    <div class="flex justify-between">
                        <a href="./login.php" type="button"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 ">
                            Buy now
                        </a>
                        <a href="./login.php" type="button"
                            class="text-red-700 bg-red-100 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2">
                            <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 18 21">
                                <path
                                    d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                            </svg>
                            Add to Cart
                        </a>
                    </div>
                </div>

                <?php } else {  ?>

                <div class="flex items-center justify-between mt-7
">
                    <div class="flex justify-between">
                        <a href="./check_out.php?prod_id=<?php echo $product['prod_id']; ?>" type="button"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 ">
                            Buy now
                        </a>
                        <a href="./check_out.php" type="button"
                            class="text-red-700 bg-red-100 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2">
                            <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 18 21">
                                <path
                                    d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                            </svg>
                            Add to Cart
                        </a>
                    </div>
                </div>

                <?php }   ?>
            </div>
        </div>
    </form>

    <?php include './components/footer.php';  ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const decrementButton = document.getElementById('decrement-button');
        const incrementButton = document.getElementById('increment-button');
        const quantityInput = document.getElementById('quantity-input');

        decrementButton.addEventListener('click', function() {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                value--;
                quantityInput.value = value;
            }
        });

        incrementButton.addEventListener('click', function() {
            let value = parseInt(quantityInput.value);
            value++;
            quantityInput.value = value;
        });
    });
    </script>
</body>