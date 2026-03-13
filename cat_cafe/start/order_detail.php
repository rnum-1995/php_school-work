<?php
require_once './inc/functions.php';

$id = $_GET['id'];

echo $id;

$db = db_connect();

$order = [];
$err_msg = '';

try {
  $sql = 'SELECT orders.receipt_no, orders.register_date, branches.name AS branch_name, staff.name AS staff_name, order_details.menu_id, menus.name AS menu_name, order_details_options.menu_option, menus.price, order_details.qty FROM orders INNER JOIN branches ON orders.branch_id = branches.id INNER JOIN staff ON orders.staff_id = staff.id INNER JOIN order_details ON orders.receipt_no = order_details.receipt_no INNER JOIN menus ON order_details.menu_id = menus.id LEFT OUTER JOIN order_details_options ON order_details.id = order_details_options.order_detail_id WHERE orders.id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $order = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $err_msg = 'データの取得に失敗しました: ' . $e->getMessage();
}

// 成功メッセージの表示用（リダイレクト時など）
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);

$page_title = '注文詳細';
require_once 'inc/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="mb-0">注文詳細</h2>
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
  <?php if (!empty($order)): ?>
    <?php
    $basic_data = []; // 基本情報
    $menu_data = []; // メニュー情報
    $total_data = []; // 合計情報

    $basic_data = [
      'receipt_no' => $order[0]['receipt_no'],
      'register_date' => $order[0]['register_date'],
      'branch_name' => $order[0]['branch_name'],
      'staff_name' => $order[0]['staff_name'],
    ];

    foreach ($order as $data) {
      $menu_data[$data['menu_id']]['menu_name'] = $data['menu_name'];
      $menu_data[$data['menu_id']]['qty'] = $data['qty'];
      $menu_data[$data['menu_id']]['subtotal'] = $data['price'] * $data['qty'];
      // メニューにオプションが指定されていたら、配列でオプション名を格納
      if (!is_null($data['menu_option'])) {
        $menu_data[$data['menu_id']]['options'][] = $data['menu_option'];
      }
    }
    $total_data['total_qty'] = 0;
    $total_data['total_price'] = 0;

    foreach ($menu_data as $menu) {
      $total_data['total_qty'] += $menu['qty'];
      $total_data['total_price'] += $menu['subtotal'];
    }
    ?>
    <table class="table">
      <thead>
        <tr>
          <th>レシートNo</th>
          <th>レジ日時</th>
          <th>店舗</th>
          <th>対応スタッフ</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $basic_data['receipt_no']; ?></td>
          <td><?php echo date('Y/d/m H:i', strtotime($basic_data['register_date'])); ?></td>
          <td><?php echo $basic_data['branch_name']; ?></td>
          <td><?php echo $basic_data['staff_name']; ?></td>
        </tr>
      </tbody>
    </table>

    <dl class="row">
      <?php foreach ($menu_data as $data): ?>
        <dt class="col-8">
          <?php echo $data['menu_name']; ?>
          <?php if (isset($data['options'])): ?>
            (
            <?php foreach ($data['options'] as $option): ?>
              <?php echo $option; ?>
            <?php endforeach; ?>
            )
          <?php endif; ?>
        </dt>
        <dd class="col-2"><?php echo $data['qty']; ?>個</dd>
        <dd class="col-2"><?php echo $data['subtotal']; ?>円</dd>
      <?php endforeach; ?>
      <dt class="col-10">点数</dt>
      <dd class="col-2"><?php echo $total_data['total_qty'] ?>点</dd>
      <dt class="col-10">合計</dt>
      <dd class="col-2"><?php echo $total_data['total_price'] ?>円</dd>
    </dl>
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

<?php require_once 'inc/footer.php'; ?>