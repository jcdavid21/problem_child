<nav>
        <ul class="sidebar">
            
            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li>
            <!-- Mobile Search Bar -->
            <div class="box">
                <form id="searchFormMobile">
                    <input type="text" id="searchInputMobile" name="search" placeholder="Search..." value="">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            </li>
            <li><a href="../index.php" class="active">Home</a></li>
            <li><a href="../shop/shop.php" class="active" >Shop</a></li>
            <li><a href="../sizechart/sizechart.php" class="active">Size</a></li>
            <li><a href="../contact/contact.php" class="active">Contact</a></li>
            <li><a href="../cart/cart.php" class="active">Cart</a></li>
            <li><a href="../profile/profile.php" class="active">Profile</a></li>
            <li><a href="../logout/logout.php" class="active">Logout</a></li>
        </ul>
        <ul>
            
            <li><a href="../index.php" class="name"><img class="logo" src="../images/logoR1.png">PROBLEM CHILD</a></li>
            <li class="hideOnMobile"><a href="../index.php" class="active">Home</a></li>
            <li class="hideOnMobile"><a href="../shop/shop.php" class="active" >Shop</a></li>
            <li class="hideOnMobile"><a href="../sizechart/sizechart.php" class="active">Size</a></li>
            <li class="hideOnMobile"><a href="../contact/contact.php" class="active">Contact</a></li>
            <li class="hideOnMobile">
            <!-- Desktop Search Bar -->
            <div class="box hideOnMobile">
                <form id="searchFormDesktop">
                    <input type="text" id="searchInputDesktop" name="search" placeholder="Search..." value="">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            </li>
            <li class="hideOnMobile">
            <div class="cart1">
                <a href="../cart/cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            </li>
            </li>
            <li class="hideOnMobile">
            <div class="user">
                <a href="../profile/profile.php"><i class="fa-regular fa-user"></i></a>
                <!-- User menu -->
                <div class="user-menu" style="<?php echo isset($_SESSION['user_id']) ? 'right: -5px;' : ''; ?>">
                  <a href="../profile/profile.php">My Account</a>
                  <a href="../components/pendingOrders.php">My Purchases</a>
                  <a href="../logout/logout.php">Logout</a>
                </div>
            </div>
            </li>
            <li class="hideOnMobile">
                <div class="login">
                    <?php
                        // Check if the user is logged in
                        if(isset($_SESSION['user_id'])) {
                            
                        } else {
                            // User is not logged in, display the login button
                            echo '<a href="../login/login.php"><button class="button-74" role="button">Login</button></i></a>';
                        }
                    ?>
                </div>
            </li>
            <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>

    <script>
        // Add event listener for desktop search form
        document.getElementById('searchFormDesktop').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the form from refreshing the page
            const searchQuery = document.getElementById('searchInputDesktop').value;

            // direct to index.php
            window.location.href = `../index.php?search=${encodeURIComponent(searchQuery)}`;
            
        });

        // Add event listener for mobile search form
        document.getElementById('searchFormMobile').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the form from refreshing the page
            const searchQuery = document.getElementById('searchInputMobile').value;

            // direct to index.php
            window.location.href = `../index.php?search=${encodeURIComponent(searchQuery)}`;
        });


    </script>