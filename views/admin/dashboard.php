<?php
require_once dirname(__DIR__) . "/admin/layouts/header.php";
?>

<h2 class="mb-4">Dashboard</h2>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Tổng Sản Phẩm</h5>
                <h2><?= number_format($stats['total_products']) ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Tổng Đơn Hàng</h5>
                <h2><?= number_format($stats['total_orders']) ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Tổng Khách Hàng</h5>
                <h2><?= number_format($stats['total_customers']) ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Doanh Thu Tháng</h5>
                <h2><?= number_format($stats['revenue_month'], 0, ',', '.') ?> đ</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Đơn Hàng Mới Nhất</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mã Đơn</th>
                            <th>Khách Hàng</th>
                            <th>Ngày Đặt</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentOrders)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Chưa có đơn hàng nào</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($recentOrders as $order): ?>
                            <tr>
                                <td>#<?= $order['order_id'] ?></td>
                                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                                <td><?= number_format($order['total_amount'], 0, ',', '.') ?> đ</td>
                                <td><span class="badge bg-info"><?= htmlspecialchars($order['status_name']) ?></span></td>
                                <td>
                                    <a href="<?= BASE_URL ?>admin/orderDetail/<?= $order['order_id'] ?>" class="btn btn-sm btn-primary">Chi Tiết</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once dirname(__DIR__) . "/admin/layouts/footer.php"; ?>

