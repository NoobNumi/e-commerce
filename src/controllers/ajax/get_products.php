<?php
include '../connection.php';
$category = isset($_GET['category']) ? $_GET['category'] : null;

if ($category) {
    $stmt = $conn->prepare("
        SELECT p.prod_id, p.prod_name, p.price, p.stocks, pi.img_directory, c.category_name
        FROM products p
        INNER JOIN category c ON p.category_id = c.category_id
        INNER JOIN (
            SELECT prod_id, MIN(img_id) AS min_img_id
            FROM product_images
            GROUP BY prod_id
        ) min_img ON p.prod_id = min_img.prod_id
        INNER JOIN product_images pi ON min_img.min_img_id = pi.img_id
        WHERE c.category_name = :category
    ");
    $stmt->bindParam(':category', $category);
} else {
    $stmt = $conn->prepare("
        SELECT p.prod_id, p.prod_name, p.price, p.stocks, pi.img_directory, c.category_name
        FROM products p 
        INNER JOIN category c ON p.category_id = c.category_id
        INNER JOIN (
            SELECT prod_id, MIN(img_id) AS min_img_id
            FROM product_images
            GROUP BY prod_id
        ) min_img ON p.prod_id = min_img.prod_id
        INNER JOIN product_images pi ON min_img.min_img_id = pi.img_id
    ");
}

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(empty($products)) {
    echo '<div class="left-0 w-full h-auto absolute flex justify-center items-center overflow-hidden">
    <img class="h-96 max-w-full object-cover" src="../images/no_products_found.png" alt="No products">
</div>' ;
} else {
    foreach ($products as $row) {
?>
<div class="product-container">
    <!-- SKELETON -->
    <div role="status"
        class="skeleton max-w-sm p-4 border border-gray-200 rounded shadow animate-pulse md:p-6 dark:border-gray-700">
        <div class="flex items-center justify-center h-48 mb-4 bg-gray-300 rounded dark:bg-gray-700">
            <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                <path
                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
            </svg>
        </div>
        <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
        <div class="flex items-center gap-5 mt-7">
            <div class="h-10 bg-gray-200 rounded dark:bg-gray-700 w-32"></div>
            <div class="h-10 bg-gray-200 rounded dark:bg-gray-700 w-32"></div>
        </div>
        <span class="sr-only">Loading...</span>
    </div>

    <!-- PRODUCT -->
    <div data-category="<?php echo $row['category_name']; ?>"
        class="product w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="./product_info.php?prod_id=<?php echo $row['prod_id']; ?>" class="h-96 block">
            <img class="rounded-t-lg object-cover object-center h-full w-full"
                src="<?php echo $row['img_directory'] ?? '../images/placeholder.svg'; ?>" alt="product image" />
        </a>
        <div class="px-5 pb-5">
            <a href="./product_info.php?prod_id=<?php echo $row['prod_id']; ?>">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                    <?php echo $row['prod_name']; ?>
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
                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                </div>
                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded ms-3">5.0</span>
            </div>
            <span class="text-3xl font-bold text-gray-900 dark:text-white">₱<?php echo $row['price']; ?></span>
        </div>
    </div>
</div>
<?php 
    } 
}
?>