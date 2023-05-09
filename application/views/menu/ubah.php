<div class="d-flex justify-content-between align-items-center">
    <h3>Daftar Kategori</h3>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Menu</li>
        </ol>
    </nav>
</div>
<hr>

<form action="" method="post">
    <div class="mb-3">
        <input type="hidden" name="id" value="<?= $id; ?>">
    </div>

    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Menu</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <select class="form-control" id="kategori" name="kategori">
                <!-- <option disabled value="">Pilih Kategori</option> -->
                <?php foreach ($kategori as $k) : ?>
                    <option value="<?= $k->id; ?>" <?= $kategori_id == $k->id ? "selected" : ""; ?>><?= $k->nama; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="stok" name="stok" value="<?= $stok; ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="harga" name="harga" value="<?= $harga; ?>">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>