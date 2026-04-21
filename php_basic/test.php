<?php
// タイムゾーンを日本時間に設定
date_default_timezone_set('Asia/Tokyo');

// 価格表を配列で定義
$prices = [
  "lp" => 12000,    // ランディングページ
  "form" => 8000,   // お問い合わせフォーム
  "ops" => 5000     // 運用サポート
];

// 数量を配列で定義
$quantities = [
  "lp" => 2,     // ランディングページを2個
  "form" => 1,   // お問い合わせフォームを1個
  "ops" => 0     // 運用サポートを0個
];

// 合計金額を計算
$total = 0;

foreach ($quantities as $key => $qty) {
  if (isset($prices[$key])) {
    $subtotal = $prices[$key] * $qty;
    $total += $subtotal;

    echo $key . ": " . $prices[$key] . "円 × " . $qty . "個 = " . $subtotal . "円<br>";
  }
}

echo "<br>";
echo "合計: " . number_format($total) . "円";
?>