<form action="" method="post">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="hp" class="col-sm-2 col-form-label">No HP</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="hp" name="hp" value="<?= $hp; ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
            <textarea name="alamat" id="alamat" class="form-control" rows="3"><?= $alamat; ?></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>