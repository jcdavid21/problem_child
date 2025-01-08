<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    @media (max-width: 1000px){
      .sidebar-offcanvas{
        height: 100%;
        padding-top: 50px;
        top: 30px;
      }
    }
  </style>
</head>
<body>
<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #FAE9D7;">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="./index.php">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item nav-category">Manage</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Manage Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
            <?php
                $query = "SELECT * FROM category";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                while($data = $result->fetch_assoc()){
                    $prodId = $data["category_id"];
                    $prodName = $data["category_name"];
            ?>
            <li class="nav-item" data-type-id="<?php echo $prodId; ?>"> <a class="nav-link prod-type" data-type-id="<?php echo $prodId; ?>" href="#"><?php echo $prodName; ?></a></li>
            <?php } ?>
            <li class="nav-item">
                <a href="./disabledItems.php" class="nav-link">
                  DISABLED ITEMS
                </a>
            </li>
        </ul>
      </div>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="./addprod.php">
        <i class="menu-icon mdi mdi-plus-circle-outline"></i>
          <span class="menu-title">Add Products</span>
        </a>
      </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="menu-icon mdi mdi-account-circle-outline"></i>
        <span class="menu-title">Accounts</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="customers.php">Active</a></li>
          <!-- <li class="nav-item">  <a class="nav-link" href="deactivated.php">Deactivated</a></li> -->
          <!-- <li class="nav-item"> <a class="nav-link" href="createAccount.php">Create Account</a></li> -->
        </ul>
      </div>
    </li>

    <!-- reviews -->
    <li class="nav-item">
      <a class="nav-link" href="./reviews.php">
      <i class="menu-icon mdi mdi-comment-account-outline"></i>
        <span class="menu-title">Reviews</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="./auditlogs.php">
      <i class="menu-icon mdi mdi-account-switch"></i>
        <span class="menu-title">User Logs</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="./auditTrail.php">
      <i class="menu-icon mdi mdi-arrange-send-to-back"></i>
        <span class="menu-title">Activity Logs</span>
      </a>
    </li>

    <li class="nav-item nav-category">ORDERS</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Manage Orders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-orders">
        <ul class="nav flex-column sub-menu">

            <li class="nav-item">
                <a class="nav-link" href="./tableReceipts.php">Receipts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./tableOrders.php">Online Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./tableShipped.php">Shipped Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./tableDelivered.php">Delivered Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./POSales.php">
                POS (Sales)
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./tableDeclined.php">Declined Orders</a>
            </li>
        </ul>
      </div>
    </li>

    <!-- Point of sale -->
    <li class="nav-item">
      <a class="nav-link" href="./pos.php">
        <i class="menu-icon mdi mdi-cash"></i>
        <span class="menu-title pos">Point of Sale</span>
      </a>
    </li>

    <li class="nav-item trans">
      <a class="nav-link" href="./transHistory.php">
        <i class="menu-icon mdi mdi-file-document"></i>
        <span class="menu-title">Transactions</span>
      </a>
    </li>
  </ul>
</nav>
</body>
</html>