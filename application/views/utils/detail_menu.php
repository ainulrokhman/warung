<?php foreach ($data as $d) : ?>
    <div class="row mb-3">
        <div class="col"><?= $d->nama_menu; ?></div>
        <div class="col"><?= $d->qty; ?></div>
        <div class="col text-end"><?= formatRupiah($d->harga); ?></div>
    </div>
<?php endforeach; ?>