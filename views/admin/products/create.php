<?php
require_once "layouts/header.php";
?>

<h2 class="mb-4">Thêm Sản Phẩm Mới</h2>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>admin/productCreate">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Tên Sản Phẩm *</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Thương Hiệu *</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh Mục</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">Chọn danh mục</option>
                            <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['category_id'] ?>">
                                <?= htmlspecialchars($category['category_name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô Tả</label>
                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Nhà Cung Cấp</label>
                        <input type="number" class="form-control" id="supplier_id" name="supplier_id">
                    </div>
                    <button type="submit" class="btn btn-primary">Tạo Sản Phẩm</button>
                    <a href="<?= BASE_URL ?>admin/products" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once "layouts/footer.php"; ?>

