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

<a href="<?= base_url('kategori/tambah'); ?>" class="btn btn-primary text-decoration-none">Tambah Kategori</a>

<div class="mt-3"><?php echo $this->session->flashdata('notify'); ?></div>
<hr>
<table id="example" class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($kategori as $k) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $k->nama; ?></td>
                <td>
                    <a href="<?= base_url("kategori/ubah/$k->id"); ?>" class="text-decoration-none text-white">
                        <span class="badge bg-info"><i class="fas fa-edit"></i> Ubah</span>
                    </a>
                    <a href="<?= base_url("kategori/hapus/$k->id"); ?>" onclick='return confirm("Hapus kategori \"<?= $k->nama; ?>\"?")' class="text-decoration-none text-white">
                        <span class="badge bg-danger"><i class="fas fa-trash"></i> Hapus</span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();

        function cek() {
            alert("cek")
        }
    });
</script>