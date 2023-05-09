<div class="d-flex justify-content-between align-items-center">
    <h3>Daftar Kategori</h3>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Kategori</li>
        </ol>
    </nav>
</div>
<hr>

<form action="" method="post">
    <div class="mb-3">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <label for="nama" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>