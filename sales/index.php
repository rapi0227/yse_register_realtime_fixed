<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=yse_db;charset=utf8", "root", "");
} catch (PDOException $e) {
    exit("DB接続エラー: " . $e->getMessage());
}

// 新規売上データの挿入処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームからのデータ取得
    $amount = $_POST['amount']; // 金額
    $quantity = $_POST['quantity']; // 数量
    $tax = $amount * 0.1; // 10% の税
    $total = $amount + $tax; // 合計金額（税を含む）

    // SQL文を準備
    $sql = "INSERT INTO sales (amount, created_at, quantity, tax, total) 
            VALUES (:amount, NOW(), :quantity, :tax, :total)";
    
    // SQLの実行
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':amount' => $amount,
        ':quantity' => $quantity,
        ':tax' => $tax,
        ':total' => $total
    ]);

    echo "新しい売上データが正常に追加されました！";
}

// 売上データの取得
$stmt = $pdo->query("SELECT * FROM sales ORDER BY created_at DESC");
$sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>売上一覧</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">売上一覧</h1>

    <!-- 新規売上データ追加フォーム -->
    <form action="" method="POST" class="mb-6">
        <div class="mb-4">
            <label for="amount" class="block text-gray-700">金額</label>
            <input type="number" name="amount" id="amount" required class="w-full p-2 border border-gray-300 rounded" placeholder="金額">
        </div>
        <div class="mb-4">
            <label for="quantity" class="block text-gray-700">数量</label>
            <input type="number" name="quantity" id="quantity" required class="w-full p-2 border border-gray-300 rounded" placeholder="数量">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">売上を追加</button>
    </form>

    <!-- 売上一覧テーブル -->
    <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-200 text-gray-600 text-left">
            <tr>
                <th class="py-2 px-4">日時</th>
                <th class="py-2 px-4">金額</th>
                <th class="py-2 px-4">数量</th>
                <th class="py-2 px-4">税</th>
                <th class="py-2 px-4">合計</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $sale): ?>
            <tr class="border-t">
                <td class="py-2 px-4"><?= htmlspecialchars($sale["created_at"]) ?></td>
                <td class="py-2 px-4">￥<?= number_format($sale["amount"]) ?></td>
                <td class="py-2 px-4"><?= htmlspecialchars($sale["quantity"]) ?></td>
                <td class="py-2 px-4">￥<?= isset($sale["tax"]) ? number_format($sale["tax"]) : '0' ?></td>
                <td class="py-2 px-4 font-bold">￥<?= isset($sale["total"]) ? number_format($sale["total"]) : '0' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="../index.php" class="inline-block mt-4 text-blue-500 hover:underline">戻る</a>
</body>
</html>
