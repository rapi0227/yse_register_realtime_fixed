<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=yse_db;charset=utf8", "root", "");
} catch (PDOException $e) {
    exit("DB接続エラー: " . $e->getMessage());
}
?>
<?php
$tax = isset($_POST['tax']) ? $_POST['tax'] : 0;
$total = isset($_POST['total']) ? $_POST['total'] : 0;

echo "税額：￥{$tax}<br>";
echo "合計：￥{$total}<br>";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>YSEレジ</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <div class="flex justify-between mb-4">
            <form action="update.php" method="post" class="w-full">
                <input type="text" id="display" name="price" readonly class="w-full text-3xl text-right p-2 border rounded bg-gray-50 mb-2" />
                    <input type="hidden" name="tax" value="">
                    <input type="hidden" name="total" value="">

                <div class="grid grid-cols-4 gap-2 mb-2">
                    <button type="button" onclick="addNumber('7')" class="btn">7</button>
                    <button type="button" onclick="addNumber('8')" class="btn">8</button>
                    <button type="button" onclick="addNumber('9')" class="btn">9</button>
                    <button type="button" onclick="clearAll()" class="btn bg-red-400 text-white">AC</button>
                    <button type="button" onclick="addNumber('4')" class="btn">4</button>
                    <button type="button" onclick="addNumber('5')" class="btn">5</button>
                    <button type="button" onclick="addNumber('6')" class="btn">6</button>
                    <button type="button" onclick="calculate('+')" class="btn bg-yellow-300">＋</button>
                    <button type="button" onclick="addNumber('1')" class="btn">1</button>
                    <button type="button" onclick="addNumber('2')" class="btn">2</button>
                    <button type="button" onclick="addNumber('3')" class="btn">3</button>
                    <button type="button" onclick="calculate('*')" class="btn bg-yellow-300">×</button>
                    <button type="button" onclick="addNumber('0')" class="btn">0</button>
                    <button type="button" onclick="addNumber('00')" class="btn">00</button>
                    <button type="button" onclick="calculateTax()" class="btn bg-gray-400 text-white">Tax</button>
                    <button type="button" onclick="calculateTotal()" class="btn bg-gray-600 text-white">＝</button>
                </div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded">計上</button>
            </form>
        </div>
        <div class="flex justify-between mt-4">
            <a href="sales/" class="text-blue-500 hover:underline">売上</a>
            <div id="totalDisplay" class="font-bold text-lg">売上: ￥0</div>
        </div>
    </div>
    <script src="js/app.js"></script>
</body>
</html>

