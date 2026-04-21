<!-- 問題1: fopenの並べ替え -->
<?php
$file = fopen("applications.csv", "a");
?>

<!-- 問題2: fputcsvの穴埋め -->
<?php
$file = fopen("applications.csv", "a");
$data = ["2025-01-10", 2, 1, 0, 24000];
fputcsv("applications.csv", $data);
?>

<!-- 問題3: fcloseの並べ替え -->
<?php
$file = fopen("applications.csv", "a");
fputcsv($file, $data);
fclose($file);
?>

<!-- 問題4: date関数の穴埋め -->
<?php
$datetime = date("Y-m-d H:i:s");
?>

<!-- 問題5: タイムゾーンの並べ替え -->
<?php
date_default_timezone_set("Asia/Tokyo");
?>

<!-- 問題6: 配列にデータを格納する穴埋め -->
<?php
$application_data = [
  date("Y-m-d H:i:s"),
  $qty_lp,
  $qty_form,
  $qty_ops,
  $total
];
?>

<!-- 問題7: headerでリダイレクトする並べ替え -->
<?php
// CSVにデータを保存した後
header("Location: thanks.html");
?>

<!-- 問題8: exitの穴埋め -->
<?php
header("Location: thanks.html");
exit;
?>

<!-- 問題9: 申し込みボタンの並べ替え -->
<button type="submit" name="submit_application">この内容で申し込む</button>

<!-- 問題10: 申し込みボタンの押下を確認する穴埋め -->
<?php
if (isset($_POST["submit_application"])) {
  // 申し込みデータをCSVに保存する処理
}
?>