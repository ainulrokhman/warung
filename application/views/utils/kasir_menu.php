<?php $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nama))); ?>
<div class="row">
    <div class="col">
        <input type="hidden" name="id[]" value="<?= $id; ?>">
        <?= $nama; ?>
        <br>
        <i><?= formatRupiah($harga); ?></i> stok <?= $stok; ?>
    </div>
    <div class="col-3">
        <input data-stok="<?= $stok; ?>" data-slug="<?= $slug; ?>" data-harga="<?= $harga; ?>" class="form-control qty <?= $slug; ?>" type="number" name="qty[]" value="1" max="<?= $stok; ?>" min="1">
    </div>
    <div class="col-3">
        <div class="text-end harga-<?= $slug; ?>">
            <?= formatRupiah($harga); ?>
        </div>
    </div>
    <div class="col-auto">
        <i data-slug="<?= $slug; ?>" class="fas fa-trash text-danger ms-3 hapus"></i>
    </div>
    <hr>
</div>