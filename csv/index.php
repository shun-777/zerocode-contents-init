<?php
// タイムゾーンを日本時間に設定
date_default_timezone_set('Asia/Tokyo');

// 商品の価格リストを連想配列で定義
$PRICE = [
  'lp' => 12000,    // ランディングページ
  'form' => 8000,   // お問い合わせフォーム
  'ops' => 5000     // 運用サポート
];

// 数量を保持する変数を初期化
$qty_lp = 0;
$qty_form = 0;
$qty_ops = 0;

// 合計金額を保存する変数を初期化
$total = 0;

// 「見積り更新」ボタンが押されたかチェック
if (isset($_POST['update_estimate'])) {
  // フォームから送られてきた数量データを取得
  $qty_lp = isset($_POST['q']['lp']) ? (int)$_POST['q']['lp'] : 0;
  $qty_form = isset($_POST['q']['form']) ? (int)$_POST['q']['form'] : 0;
  $qty_ops = isset($_POST['q']['ops']) ? (int)$_POST['q']['ops'] : 0;
  
  // 数量を0〜9の範囲に制限
  $qty_lp = max(0, min($qty_lp, 9));
  $qty_form = max(0, min($qty_form, 9));
  $qty_ops = max(0, min($qty_ops, 9));
  
  // 合計金額を計算
  $total = ($PRICE['lp'] * $qty_lp) + ($PRICE['form'] * $qty_form) + ($PRICE['ops'] * $qty_ops);
}

// 「申し込む」ボタンが押されたかチェック
if (isset($_POST['submit_application'])) {
  // 数量データを取得
  $qty_lp = isset($_POST['q']['lp']) ? (int)$_POST['q']['lp'] : 0;
  $qty_form = isset($_POST['q']['form']) ? (int)$_POST['q']['form'] : 0;
  $qty_ops = isset($_POST['q']['ops']) ? (int)$_POST['q']['ops'] : 0;
  
  // 数量を0〜9の範囲に制限
  $qty_lp = max(0, min($qty_lp, 9));
  $qty_form = max(0, min($qty_form, 9));
  $qty_ops = max(0, min($qty_ops, 9));
  
  // 合計金額を計算
  $total = ($PRICE['lp'] * $qty_lp) + ($PRICE['form'] * $qty_form) + ($PRICE['ops'] * $qty_ops);
  
  // 保存するデータを準備
  $application_data = [
    date("Y-m-d H:i:s"),  // 現在の日時
    $qty_lp,              // LP数量
    $qty_form,            // フォーム数量
    $qty_ops,             // 運用数量
    $total                // 合計金額
  ];
  
  // applications.csv を追記モードで開く
  $file = fopen('applications.csv', 'a');
  
  // ファイルに1行書き込む
  fputcsv($file, $application_data);
  
  // ファイルを閉じる
  fclose($file);
  
  // 完了ページに移動（リダイレクト）
  header('Location: thanks.html');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>価格シミュレーター</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form action="" method="POST">
    <!-- ヒーローセクション（トップの説明部分） -->
    <div class="hero">
      <h1>価格シミュレーター</h1>
      <p>必要なサービスを選んで、見積りを確認しましょう。</p>
    </div>

    <!-- 価格カードのコンテナ -->
    <div class="cards-container">
      
      <!-- カード1: LP制作 -->
      <div class="price-card">
        <div class="card-header">
          <span class="badge recommended">おすすめ</span>
          <h2>LP制作</h2>
          <p class="price">12,000<span>円</span></p>
        </div>
        <div class="card-body">
          <p>集客に特化した、高品質なランディングページを制作します。</p>
        </div>
        <div class="card-footer">
          <label>
            数量: <input type="number" name="q[lp]" min="0" max="9" value="<?php echo $qty_lp; ?>">
          </label>
        </div>
      </div>

      <!-- カード2: フォーム設置 -->
      <div class="price-card">
        <div class="card-header">
          <span class="badge popular">人気</span>
          <h2>フォーム設置</h2>
          <p class="price">8,000<span>円</span></p>
        </div>
        <div class="card-body">
          <p>お問い合わせフォームを設置し、顧客との接点を作ります。</p>
        </div>
        <div class="card-footer">
          <label>
            数量: <input type="number" name="q[form]" min="0" max="9" value="<?php echo $qty_form; ?>">
          </label>
        </div>
      </div>

      <!-- カード3: 運用サポート -->
      <div class="price-card">
        <div class="card-header">
          <h2>運用サポート</h2>
          <p class="price">5,000<span>円</span></p>
        </div>
        <div class="card-body">
          <p>月額制で、サイトの更新や保守をサポートします。</p>
        </div>
        <div class="card-footer">
          <label>
            数量: <input type="number" name="q[ops]" min="0" max="9" value="<?php echo $qty_ops; ?>">
          </label>
        </div>
      </div>

    </div>
    <div class="estimate-section">
      <button type="submit" name="update_estimate" class="btn-update">見積りを更新</button>

      <?php if ($total > 0): ?>
        <p class="total">概算合計：<strong><?php echo number_format($total); ?>円</strong></p>
        <button type="submit" name="submit_application" class="btn-submit">この内容で申し込む</button>
      <?php endif; ?>
    </div>
  </form>
</body>
</html>


