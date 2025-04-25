<?php
header("Content-Type: application/json");
try {
    $pdo = new PDO("mysql:host=localhost;dbname=yse_db;charset=utf8", "root", "");
} catch (PDOException $e) {
    echo json_encode(["total" => 0]);
    exit;
}
$stmt = $pdo->query("SELECT SUM(total) AS total FROM sales");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode(["total" => $result["total"]]);
?>