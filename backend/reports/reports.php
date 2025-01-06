<?php 
    require_once("../../config/dbcon.php");
    
    function report($conn, $trail_id, $trail_username, $trail_activity, $trail_user_type) {
        $trail_date = date("Y-m-d H:i:s");
        $query = "INSERT INTO tbl_audit_trail 
                  (trail_user_id, trail_username, trail_activity, trail_user_type, trail_date) 
                  VALUES (?, ?, ?, ?, ?)";
    
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
    
        $stmt->bind_param("issss", $trail_id, $trail_username, $trail_activity, $trail_user_type, $trail_date);
        
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }
        
        $stmt->close(); // Always close the statement
        return true; // Indicate success
    }
    
    
?>