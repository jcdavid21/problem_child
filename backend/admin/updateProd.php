<?php 
session_start();
require_once("../reports/reports.php");

if(isset($_POST["prod_id"], $_POST["prod_name"], $_POST["prod_price"], $_POST["variationSmall"], $_POST["variationMedium"], 
         $_POST["variationLarge"], $_POST["variationExtraLarge"], $_POST["productDesc"], 
         $_POST["updatedSmallStock"], $_POST["updatedMediumStock"], 
         $_POST["updatedLargeStock"], $_POST["updatedExtraLargeStock"])) {

    $prod_id = $_POST["prod_id"];
    $prod_name = $_POST["prod_name"];
    $prod_price = $_POST["prod_price"];
    $account_id = $_SESSION["user_id"];
    $variationSmall = $_POST["variationSmall"];
    $variationMedium = $_POST["variationMedium"];
    $variationLarge = $_POST["variationLarge"];
    $variationExtraLarge = $_POST["variationExtraLarge"];
    $product_desc = $_POST["productDesc"];
    $updatedStocks = [
        [$variationSmall, $_POST["updatedSmallStock"]],
        [$variationMedium, $_POST["updatedMediumStock"]],
        [$variationLarge, $_POST["updatedLargeStock"]],
        [$variationExtraLarge, $_POST["updatedExtraLargeStock"]],
    ];

    try {
        $conn->autocommit(false); // Start transaction

        // Update product details
        $query = "UPDATE product SET product_name=?, price=?, product_desc=? WHERE product_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdsi", $prod_name, $prod_price, $product_desc, $prod_id);
        if(!$stmt->execute()) {
            throw new Exception("Failed to update product details.");
        }

        // Update size variations
        $query3 = "UPDATE product_size_variation SET quantity_in_stock=? WHERE variation_id=?";
        $stmt3 = $conn->prepare($query3);
        foreach ($updatedStocks as $stock) {
            $stmt3->bind_param("ii", $stock[1], $stock[0]);
            if(!$stmt3->execute()) {
                throw new Exception("Failed to update size variation stocks.");
            }
        }

        // Log admin action
        $query2 = "SELECT CONCAT(first_name, ' ', last_name) as ac_username FROM users WHERE user_id=?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $account_id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $row = $result->fetch_assoc();
        $username = $row["ac_username"];
        
        $activity = "Updated product details for product ID: $prod_id";
        $type = "Admin";
        if(!report($conn, $account_id, $username, $activity, $type)) {
            throw new Exception("Failed to log admin action.");
        }


        $conn->commit(); // Commit transaction
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        $conn->rollback(); // Rollback on error
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        if ($stmt) $stmt->close();
        if ($stmt3) $stmt3->close();
        if ($stmt2) $stmt2->close();
        $conn->close();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
