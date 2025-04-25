<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=yse_db;charset=utf8", "root", "");
} catch (PDOException $e) {
    exit("DB接続エラー: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $price = $_POST['price'];

    // Insert the price into the database or perform any necessary action
    $stmt = $pdo->prepare("INSERT INTO sales (amount) VALUES (:amount)");
    $stmt->execute([':amount' => $price]);

    echo "計上しました: ￥" . $price;
}
?>
