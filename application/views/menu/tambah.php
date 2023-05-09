<form action="" method="post">
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Menu</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name="nama">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <select class="form-control" id="kategori" name="kategori">
                <option selected disabled value="">Pilih Kategori</option>
                <?php foreach ($kategori as $k) : ?>
                    <option value="<?= $k->id; ?>"><?= $k->nama; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="stok" name="stok">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="harga" name="harga">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>