<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <style>
    /* General Body and Layout Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    color: #333;
}

.container {
    margin-top: 20px;
}

h1 {
    font-size: 2.5rem;
    font-weight: 600;
    color: #333;
}

/* Card Styles */
.card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden;
    background-color: #fff;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
}

.card-img-top {
    max-height: 200px;
    object-fit: cover;
}

/* Card Body Styles */
.card-body {
    padding: 15px;
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
    color: #555;
}

.card-text {
    font-size: 1rem;
    color: #777;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

/* Cart Styles */
.cart {
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 15px;
    max-height: 500px;
    overflow-y: auto;
}

/* Cart Item Styles */
.cart-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.cart-item:hover {
    background-color: #f1f1f1;
}

.cart-item img {
    width: 60px;
    height: auto;
    margin-right: 10px;
    border-radius: 5px;
}

.cart-item h5 {
    margin: 0;
    font-size: 1rem;
    color: #333;
}

.cart-item p {
    margin: 5px 0;
    font-size: 0.9rem;
    color: #777;
}

.cart-item input[type="number"] {
    width: 60px;
    margin-top: 10px;
}

.cart-item .btn-danger {
    margin-top: 10px;
    padding: 5px 10px;
    font-size: 0.8rem;
    border-radius: 5px;
    background-color: #dc3545;
    color: #fff;
    border: none;
}

.cart-item .btn-danger:hover {
    background-color: #c82333;
}

/* Responsive Design */
@media (max-width: 768px) {
    .col-sm-4 {
        margin-bottom: 20px;
    }

    .cart {
        margin-top: 20px;
    }
}

/* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    background-color: #343a40;
    color: #fff;
    padding-top: 20px;
    transition: all 0.3s;
    z-index: 1000;
}

.sidebar a {
    color: #fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s;
}

.sidebar a:hover {
    background-color: #575d63;
}

.sidebar .active {
    width: 250px;
}

.sidebar-header {
    font-size: 1.5rem;
    color: #fff;
    font-weight: bold;
    padding-left: 15px;
    margin-bottom: 20px;
}

  </style>
</head>
<body>
    <?php
        include "./adminHeader.php";
        include "./sidebar.php";
        include_once "./config/dbconnect.php";
    ?>

    <div id="main-content" class="container allContent-section py-4">
        <h1>POINT OF SALE</h1>
        
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <!-- POS Grid for 6 items -->
                    <div class="col-sm-4">
                        <div class="card">
                            <img src="path_to_shirt_image1.jpg" class="card-img-top" alt="Ink Noir">
                            <div class="card-body">
                                <h5 class="card-title">Ink Noir</h5>
                                <p class="card-text">characterized by its dark and sophisticated design.</p>
                                <button class="btn btn-primary" onclick="addItem('Shirt 1', 'path_to_shirt_image1.jpg', 'Short description of Shirt 1')">Add</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <img src="path_to_shirt_image2.jpg" class="card-img-top" alt="Chalkboard Chic">
                            <div class="card-body">
                                <h5 class="card-title">Chalkboard Chic</h5>
                                <p class="card-text">Short description of Shirt 2.</p>
                                <button class="btn btn-primary" onclick="addItem('Shirt 2', 'path_to_shirt_image2.jpg', 'Short description of Shirt 2')">Add</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <img src="path_to_hoodie_image1.jpg" class="card-img-top" alt="Blushing Breeze">
                            <div class="card-body">
                                <h5 class="card-title">Blushing Breeze</h5>
                                <p class="card-text">Short description of Hoodie 1.</p>
                                <button class="btn btn-primary" onclick="addItem('Hoodie 1', 'path_to_hoodie_image1.jpg', 'Short description of Hoodie 1')">Add</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <img src="path_to_hoodie_image2.jpg" class="card-img-top" alt="Whiskered Gray">
                            <div class="card-body">
                                <h5 class="card-title">Whiskered Gray</h5>
                                <p class="card-text">Short description of Hoodie 2.</p>
                                <button class="btn btn-primary" onclick="addItem('Hoodie 2', 'path_to_hoodie_image2.jpg', 'Short description of Hoodie 2')">Add</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <img src="path_to_bottom_image1.jpg" class="card-img-top" alt="Hooded Grayscale">
                            <div class="card-body">
                                <h5 class="card-title">Hooded Grayscale</h5>
                                <p class="card-text">Short description of Bottom 1.</p>
                                <button class="btn btn-primary" onclick="addItem('Bottom 1', 'path_to_bottom_image1.jpg', 'Short description of Bottom 1')">Add</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <img src="path_to_bottom_image2.jpg" class="card-img-top" alt="Happy Brown">
                            <div class="card-body">
                                <h5 class="card-title">Happy Brown</h5>
                                <p class="card-text">Short description of Bottom 2.</p>
                                <button class="btn btn-primary" onclick="addItem('Bottom 2', 'path_to_bottom_image2.jpg', 'Short description of Bottom 2')">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart on the right side -->
            <div class="col-sm-4">
                <h2>Cart</h2>
                <div id="cart" class="cart">
                    <!-- Cart items will appear here -->
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>    
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>

    <script>
        // Function to add item to the cart
        function addItem(name, image, description) {
            let cart = document.getElementById('cart');

            // Create a new cart item
            let cartItem = document.createElement('div');
            cartItem.classList.add('cart-item', 'd-flex', 'align-items-center');

            // Add the product image, name, description, and quantity input field
            cartItem.innerHTML = `
                <img src="${image}" alt="${name}" class="img-thumbnail mr-3">
                <div>
                    <h5>${name}</h5>
                    <p>${description}</p>
                    <input type="number" class="form-control" placeholder="Quantity" value="1" min="1">
                    <button class="btn btn-danger mt-2" onclick="removeItem(this)">Remove</button>
                </div>
            `;

            // Append the new item to the cart
            cart.appendChild(cartItem);
        }

        // Function to remove an item from the cart
        function removeItem(button) {
            let cartItem = button.parentElement.parentElement;
            cartItem.remove();
        }
    </script>
</body>
</html>
