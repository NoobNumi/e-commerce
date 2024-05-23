<?php
session_start();

include '../connection.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT COUNT(*) AS num_products FROM cart WHERE user_id = :user_id";

try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo $result['num_products'];
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>