<?php
require_once "layouts/header.php";
?>

<h2 class="mb-4">Quản Lý Khách Hàng</h2>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ và Tên</th>
                <th>Điện Thoại</th>
                <th>Email</th>
                <th>Địa Chỉ</th>
                <th>Ngày Tạo</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($customers)): ?>
            <tr>
                <td colspan="7" class="text-center">Chưa có khách hàng nào</td>
            </tr>
            <?php else: ?>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= $customer['customer_id'] ?></td>
                    <td><?= htmlspecialchars($customer['full_name']) ?></td>
                    <td><?= htmlspecialchars($customer['phone_number']) ?></td>
                    <td><?= htmlspecialchars($customer['email']) ?></td>
                    <td><?= htmlspecialchars($customer['address']) ?></td>
                    <td><?= date('d/m/Y', strtotime($customer['created_at'])) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>admin/customerEdit/<?= $customer['customer_id'] ?>" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Sửa
                        </a>
                        <a href="<?= BASE_URL ?>admin/customerDelete/<?= $customer['customer_id'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Bạn có chắc muốn xóa khách hàng này?')">
                            <i class="bi bi-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once "layouts/footer.php"; ?>

