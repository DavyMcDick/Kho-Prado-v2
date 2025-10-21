<?php
include('../config/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = "UPDATE confirm SET Status = 'Cancelled' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../html/service.php?message=cancel_success");
    } else {
        header("Location: ../html/service.php?message=cancel_failed");
    }
    exit();
}
?>
