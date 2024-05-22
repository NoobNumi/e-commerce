<?php 
    include './components/header.php';
    include './components/navbar.php'; 
?>

<body>
    <?php 
        include './components/carousel.php';
        include './components/products.php';        
        include './components/footer.php'; 
    ?>

    <script>
    window.onload = function() {
        initializeProducts();
    };

    function initializeProducts() {
        var productContainers = document.querySelectorAll('.product-container');

        productContainers.forEach(function(container) {
            var skeleton = container.querySelector('.skeleton');
            var product = container.querySelector('.product');

            product.style.display = 'none';
            skeleton.style.display = 'block';

            setTimeout(function() {
                skeleton.style.display = 'none';
                product.style.display = 'block';
            }, 2000);
        });
    }

    var categoryButtons = document.querySelectorAll('[data-category]');

    categoryButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var category = button.getAttribute('data-category');

            var xhr = new XMLHttpRequest();
            var url = './ajax/get_products.php';

            if (category !== 'All') {
                url += '?category=' + encodeURIComponent(category);
            }

            xhr.open('GET', url, true);

            xhr.onload = function() {
                if (this.status == 200) {
                    var productContainer = document.querySelector('.products');
                    productContainer.innerHTML = this.responseText;
                    initializeProducts();
                } else {
                    console.error('AJAX request failed with status ' + this.status);
                }
            };

            xhr.send();
        });
    });
    </script>
</body>


</html>