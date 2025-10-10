<?php
// タイムゾーンを日本時間に設定
date_default_timezone_set('Asia/Tokyo');

// 価格リスト（連想配列）
$PRICE = [
  'lp' => 12000,
  'form' => 8000,
  'ops' => 5000
];

// 合計金額を初期化
$total = 0;

// フォームの値を保持する変数
$qty_lp = 0;
$qty_form = 0;
$qty_ops = 0;

// 「見積り更新」ボタンが押されたかチェック
if (isset($_POST['update_estimate'])) {
  // フォームから送られてきた数量データを取得
  $qty_lp = isset($_POST['q']['lp']) ? (int)$_POST['q']['lp'] : 0;
  $qty_form = isset($_POST['q']['form']) ? (int)$_POST['q']['form'] : 0;
  $qty_ops = isset($_POST['q']['ops']) ? (int)$_POST['q']['ops'] : 0;
  
  // 0〜9の範囲に制限
  $qty_lp = max(0, min($qty_lp, 9));
  $qty_form = max(0, min($qty_form, 9));
  $qty_ops = max(0, min($qty_ops, 9));
  
  // 合計を計算
  $total = ($PRICE['lp'] * $qty_lp) + ($PRICE['form'] * $qty_form) + ($PRICE['ops'] * $qty_ops);
}

// 「この内容で申し込む」ボタンが押されたかチェック
if (isset($_POST['submit_application'])) {
  // 数量データを取得
  $qty_lp = isset($_POST['q']['lp']) ? (int)$_POST['q']['lp'] : 0;
  $qty_form = isset($_POST['q']['form']) ? (int)$_POST['q']['form'] : 0;
  $qty_ops = isset($_POST['q']['ops']) ? (int)$_POST['q']['ops'] : 0;
  
  // 0〜9の範囲に制限
  $qty_lp = max(0, min($qty_lp, 9));
  $qty_form = max(0, min($qty_form, 9));
  $qty_ops = max(0, min($qty_ops, 9));
  
  // 合計を計算
  $total = ($PRICE['lp'] * $qty_lp) + ($PRICE['form'] * $qty_form) + ($PRICE['ops'] * $qty_ops);
  
  // 申し込みデータを配列にまとめる
  $application_data = [
    date('Y-m-d H:i:s'), // 現在の日時（日本時間）
    $qty_lp,
    $qty_form,
    $qty_ops,
    $total
  ];
  
  // CSVファイルを開く（なければ作成、あれば追記モード）
  $file = fopen('applications.csv', 'a');
  
  // ファイルに1行書き込む
  fputcsv($file, $application_data);
  
  // ファイルを閉じる
  fclose($file);
  
  // 処理が終わったら、完了ページに移動（リダイレクト）
  header('Location: thanks.html');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>価格シミュレーター</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="hero">
    <h1>Webサービス価格シミュレーター</h1>
    <p>必要なサービスを選んで、概算をチェック！</p>
  </div>

  <form action="index.php" method="POST">
    <div class="cards-container">
      
      <!-- カード1: ランディングページ制作 -->
      <div class="price-card">
        <div class="badge">人気</div>
        <h2>ランディングページ制作</h2>
        <p class="price">¥12,000</p>
        <p class="description">商品やサービスを魅力的に紹介する1ページ完結型のWebページを制作します。</p>
        <label>
          数量: <input type="number" name="q[lp]" min="0" max="9" value="<?php echo $qty_lp; ?>">
        </label>
      </div>

      <!-- カード2: お問い合わせフォーム -->
      <div class="price-card">
        <div class="badge recommended">おすすめ</div>
        <h2>お問い合わせフォーム</h2>
        <p class="price">¥8,000</p>
        <p class="description">ユーザーからの問い合わせを受け付けるフォームを設置します。メール送信機能付き。</p>
        <label>
          数量: <input type="number" name="q[form]" min="0" max="9" value="<?php echo $qty_form; ?>">
        </label>
      </div>

      <!-- カード3: 運用サポート -->
      <div class="price-card">
        <h2>運用サポート</h2>
        <p class="price">¥5,000</p>
        <p class="description">サイト公開後の更新作業や、トラブル対応をサポートします。月額プランもあります。</p>
        <label>
          数量: <input type="number" name="q[ops]" min="0" max="9" value="<?php echo $qty_ops; ?>">
        </label>
      </div>

    </div>

    <div class="total-container">
      <?php if ($total > 0): ?>
        <p class="total">概算合計：<strong>¥<?php echo number_format($total); ?></strong></p>
        <button type="submit" name="update_estimate" class="submit-button">見積りを更新</button>
        <button type="submit" name="submit_application" class="submit-button-secondary">この内容で申し込む</button>
      <?php else: ?>
        <p class="total">サービスを選択して、見積りを確認しましょう</p>
        <button type="submit" name="update_estimate" class="submit-button">見積りを更新</button>
      <?php endif; ?>
    </div>

  </form>
</body>
</html>