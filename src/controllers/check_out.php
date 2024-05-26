<?php 
    include './components/header.php';
    include './components/navbar.php'; 
    $response = array('success' => false, 'message' => '');
    if (!isset($_SESSION['user_id'])) {
        echo "<script>window.location.href = './home.php';</script>";
    }

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
<h1 class="text-4xl font-semibold text-center mb-4 underline-blue mt-8">Check Out</h1>
<div class="product-container container w-full flex justify-center md:flex-col mx-auto px-4 md:px-8 py-8">
    <div class="img-products px-4 order-1 md:order-none rounded-md">
        <div class="w-full p-0 md:p-6">
            <div class="flex items-center gap-4">
                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Delivery Options</h5>
                <svg class="w-6 h-6 text-red-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                </svg>
            </div>
            <hr class="h-px mt-8 mb-5 bg-gray-300 border-0 dark:bg-gray-700">
            <div class="relative">
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            First Name
                        </label>
                        <input type="text" id="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="John" required />
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Last Name
                        </label>
                        <input type="text" id="last_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Doe" required />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="countries"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                        <select id="countries"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a country</option>
                            <option value="US">United States</option>
                            <option value="CA">Canada</option>
                            <option value="FR">France</option>
                            <option value="DE">Germany</option>
                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="countries"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                        <select id="countries"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a country</option>
                            <option value="US">United States</option>
                            <option value="CA">Canada</option>
                            <option value="FR">France</option>
                            <option value="DE">Germany</option>
                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="zip-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ZIP
                            code:</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path
                                        d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                </svg>
                            </div>
                            <input type="text" id="zip-input" aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="12345 or 12345-6789" pattern="^\d{5}(-\d{4})?$" required />
                        </div>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-5 group">
                        <label for="house_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            House Number
                        </label>
                        <input type="number" id="house_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="1234" required />
                    </div>
                    <div class="relative w-full mx-auto">
                        <label for="phone_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number:</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                    <path
                                        d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                                </svg>
                            </div>
                            <input type="tel" id="phone_number" aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="09123355384" pattern="^\d{5}(-\d{4})?$" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center gap-4">
                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Payment Method</h5>
                <svg class="w-6 h-6 text-red-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1Z" />
                </svg>
            </div>
            <hr class="h-px mt-8 mb-5 bg-gray-300 border-0 dark:bg-gray-700">
            <ul class="grid mt-3 w-full gap-6 md:grid-cols-2">
                <li>
                    <input type="radio" id="hosting-small" name="hosting" value="hosting-small" class="hidden peer"
                        requiblue />
                    <label for="hosting-small"
                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">GCash</div>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/52/GCash_logo.svg" alt=""
                            class="w-auto h-5">
                    </label>
                </li>
                <li>
                    <input type="radio" id="hosting-big" name="hosting" value="hosting-big" class="hidden peer">
                    <label for="hosting-big"
                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Cash On Delivery</div>
                        </div>
                        <svg class="w-6 h-6 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M2 11a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z"
                                clip-rule="evenodd" />
                            <path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" />
                        </svg>

                    </label>
                </li>
            </ul>
        </div>
    </div>
    <div class="w-3/4 px-5 pb-5 mt-6 md:mt-0 ">
        <div class="flex items-center justify-between w-full">
            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Items: </h5>
            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Edit</a>
        </div>
        <hr class="h-px mt-8 mb-5 bg-gray-300 border-0 dark:bg-gray-700">
        <div class="grid grid-cols-2 md:flex md:items-start md:justify-start">
            <?php if (!empty($images)) { ?>
            <img class="w-28 md:w-32 max-w-full max-h-full" src="<?php echo $images[0]['img_directory']; ?>"
                alt="Product Image">
            <?php } else { ?>
            <img class="w-28 md:w-32 max-w-full max-h-full" src="../images/placeholder.svg" alt="Product Image">
            <?php } ?>
            <div class="w-full">
                <span
                    class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo $product['prod_name']; ?></span>
                <p class="text-sm text-gray-500 dark:text-gray-400">Size: M </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Quantity: 1</p>
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Price: ₱<?php echo $product['price']; ?></p>
            </div>
        </div>
        <div>
            <div class="flex items-center justify-between my-6">
                <p class="text-md text-gray-600 dark:text-white">Subtotal</p>
                <p class="text-md text-gray-600 dark:text-white">
                    ₱<?php echo $product['price']; ?>
            </div>
            <div class="flex items-center justify-between my-6">
                <p class="text-md text-gray-600 dark:text-white">Delivery</p>
                <p class="text-md text-gray-600 dark:text-white">
                    ₱<?php echo $product['price']; ?>
            </div>
            <div class="flex items-center justify-between my-6">
                <p class="text-xl font-semibold text-red-600 dark:text-white">Total</p>
                <p class="text-xl font-semibold text-red-600 dark:text-white">
                    ₱<?php echo $product['price']; ?>
            </div>
        </div>


        <div class="flex w-full justify-end p-0 mt-8">
            <button type="button"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center ">
                <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 18 21">
                    <path
                        d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                </svg>
                Buy now
            </button>
        </div>

    </div>
</div>

<?php include './components/footer.php'; ?>