<!-- 問題1: フォームタグの並べ替え -->
<form method="POST" action="index.php">

<!-- 問題2: input要素の穴埋め -->
<input type="number" name="quantity" min="0" max="9">

<!-- 問題3: button要素の並べ替え -->
<button type="submit" name="update_estimate">見積りを更新</button>

<!-- 問題4: $_POSTでデータを取得する穴埋め -->
<?php
$quantities = $_POST["q"] ?? [];
?>

<!-- 問題5: foreachで合計を計算する並べ替え -->
<?php
$total = 0;
foreach ($quantities as $key => $value) { $total += $value; }
?>

<!-- 問題6: issetでボタンの押下を確認する穴埋め -->
<?php
if (isset($_POST["update_estimate"])) {
  // 見積り更新の処理
}
?>

<!-- 問題7: 数量を保持する並べ替え -->
<input type="number" name="q[lp]" value="<?php echo $qty_lp; ?>">

<!-- 問題8: 価格を定義する穴埋め -->
<?php
$PRICE = [
  "lp" => 12000,
  "form" => 8000,
  "ops" => 5000
];
?>

<!-- 問題9: 合計金額を計算する並べ替え -->
<?php
$total = 0;
foreach ($quantities as $key => $value) {
  if (isset($PRICE[$key])) {
    $total += $PRICE[$key] * $value;
  }
}
?>

<!-- 問題10: number_formatで金額を表示する穴埋め -->
<p>概算合計: <strong>¥<?php echo number_format($total); ?></strong></p>