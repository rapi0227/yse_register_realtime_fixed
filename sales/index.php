<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=yse_db;charset=utf8", "root", "");
} catch (PDOException $e) {
    exit("DB接続エラー: " . $e->getMessage());
}
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
                <td class="py-2 px-4"><?= $sale["created_at"] ?></td>
                <td class="py-2 px-4">￥<?= number_format($sale["amount"]) ?></td>
                <td class="py-2 px-4"><?= $sale["quantity"] ?></td>
                <td class="py-2 px-4">￥<?= number_format($sale["tax"]) ?></td>
                <td class="py-2 px-4 font-bold">￥<?= number_format($sale["total"]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../index.php" class="inline-block mt-4 text-blue-500 hover:underline">戻る</a>
</body>
</html>