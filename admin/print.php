<?php
session_start();
if (empty($_SESSION["isAdmin"])) {
    header('Location:logout.php');
}
require_once("../config/dbcon.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #printableCart {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 5px;
            width: 100%;
        }

        h3, h4, h5 {
            text-align: center;
            margin: 2px 0;
            font-size: 10px;
        }

        h5{
            margin-bottom: 6px;
        }

        .card-order {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 10px;
            margin-bottom: 5px;
        }

        .total {
            border-top: 1px dashed rgba(0, 0, 0, 0.5);
            margin-top: 5px;
            padding-top: 5px;
            font-size: 10px;
            justify-content: end;
        }

        @page {
            size: 57mm 50mm; /* Specify thermal paper size */
            margin: 0; /* Removes headers and footers */
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

<div id="printableCart">
    <h3>Problem Child</h3>
    <h4>Tandang Sora, Quezon City</h4>
    <h5>Order Summary</h5>

    <?php
    if (isset($_GET["order_id"])) {
        $order_id = $_GET["order_id"];
    }
    $total = 0;

    $query_orders = "SELECT tc.cart_id, tc.quantity, tc.price, tc.status_id, tp.price as product_price, 
        tp.product_name, tp.product_image, c.category_name, tv.size_id, tv.variation_id, 
        ts.size_name, o.order_id 
        FROM cart tc 
        INNER JOIN product_size_variation tv ON tv.variation_id = tc.variation_id 
        INNER JOIN product tp ON tp.product_id = tv.product_id 
        INNER JOIN category c ON c.category_id = tp.category_id 
        INNER JOIN sizes ts ON ts.size_id = tv.size_id 
        INNER JOIN tbl_orders o ON o.cart_id = tc.cart_id
        WHERE o.order_id = ?;";
    $stmt_orders = $conn->prepare($query_orders);
    $stmt_orders->bind_param("i", $order_id);
    $stmt_orders->execute();
    $result_orders = $stmt_orders->get_result();

    while ($data = $result_orders->fetch_assoc()) {
        $total += $data['price'];
    ?>
    <div class="card-order">
        <p><?php echo $data["product_name"] . ' (' . $data["size_name"] . ')'; ?></p>
        <p><?php echo '₱' . $data["product_price"] . ' x ' . $data["quantity"]; ?></p>
    </div>
    <?php } ?>
    <div class="card-order total">
        <p>Total: ₱<?php echo $total; ?></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Trigger print dialog when the page loads
        printCart();
    });

    function printCart() {
        const printableArea = document.getElementById('printableCart').innerHTML;

        // Replace body content with printable area
        document.body.innerHTML = `
            <html>
                <head>
                    <title>Print Receipt</title>
                </head>
                <body style="text-align:center;">
                    ${printableArea}
                </body>
            </html>
        `;

        // Trigger print dialog
        window.print();
    }
</script>
</body>
</html>
