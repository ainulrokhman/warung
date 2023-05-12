<?php $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nama))); ?>
<div class="row">
    <div class="col">
        <?= $nama; ?>
        <br>
        <i><?= formatRupiah($harga); ?></i> stok <?= $stok; ?>
    </div>
    <div class="col-2">
        <input data-stok="<?= $stok; ?>" data-slug="<?= $slug; ?>" data-harga="<?= $harga; ?>" class="form-control qty <?= $slug; ?>" type="number" name="qty" value="1" max="<?= $stok; ?>" min="1">
    </div>
    <div class="col-3 text-end harga-<?= $slug; ?>">
        <?= formatRupiah($harga); ?>
    </div>
    <hr>
</div>