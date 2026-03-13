<?php
require_once './inc/functions.php';

$db = db_connect();
$orders = [];
$err_msg = '';

try {
  $sql = 'SELECT orders.id, orders.receipt_no,orders.register_date,branches.name AS branch_name,  staff.name AS staff_name FROM orders
    INNER JOIN branches ON orders.branch_id = branches.id
    INNER JOIN staff ON orders.staff_id = staff.id
    ORDER BY orders.register_date DESC;
  ';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $err_msg = 'データの取得に失敗しました: ' . $e->getMessage();
}

// 成功メッセージの表示用（リダイレクト時など）
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);

$page_title = '注文一覧';
require_once 'inc/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="mb-0">注文一覧</h2>
</div>

<?php if ($msg): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo h($msg); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if ($err_msg): ?>
  <div class="alert alert-danger">
    <?php echo h($err_msg); ?>
  </div>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
  <?php if (!empty($orders)): ?>
    <table class="table">
      <thead>
        <tr>
          <th>レシートNo</th>
          <th>レジ日時</th>
          <th>店舗</th>
          <th>対応スタッフ</th>
          <th>操作</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($orders as $order): ?>
          <tr>
            <td>
              <?php echo $order['receipt_no']; ?>
            </td>
            <td>
              <?php echo date('Y/m/d H:i', strtotime($order['register_date'])); ?>
            </td>
            <td>
              <?php echo $order['branch_name']; ?>
            </td>
            <td>
              <?php echo $order['staff_name']; ?>
            </td>
            <td>
              <a href="order_detail.php?id=<?= $order['id']; ?>">詳細</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  <?php else: ?>
    <div class="col-12">
      <div class="alert alert-info">
        注文がまだ登録されていません。
      </div>
    </div>

  <?php endif; ?>
</div>

<style>
  .text-pink {
    color: #e91e63;
  }

  .btn-outline-danger {
    color: #e91e63;
    border-color: #e91e63;
  }

  .btn-outline-danger:hover {
    background-color: #e91e63;
    color: #fff;
  }
</style>

<?php require_once './inc/footer.php'; ?>