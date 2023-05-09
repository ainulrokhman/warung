<form action="" method="post">
    <div class="mb-3">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <label for="nama" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>