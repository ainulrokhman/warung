<div class="d-flex justify-content-between align-items-center">
    <h3>Daftar Menu</h3>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Menu</li>
        </ol>
    </nav>
</div>
<hr>

<a href="<?= base_url('menu/tambah'); ?>" class="btn btn-primary text-decoration-none">Tambah Menu</a>

<div class="mt-3"><?php echo $this->session->flashdata('notify'); ?></div>
<hr>
<table id="example" class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($menu as $m) : ?>
            <?php $kategori = $this->Model_Kategori->get_by_id($m->kategori_id)->row_array(); ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $m->nama; ?></td>
                <td><?= $kategori['nama']; ?></td>
                <td><?= $m->stok; ?></td>
                <td><?= $m->harga; ?></td>
                <td>
                    <a href="<?= base_url("menu/ubah/$m->id"); ?>" class="text-decoration-none text-white">
                        <span class="badge bg-info"><i class="fas fa-edit"></i> Ubah</span>
                    </a>
                    <a href="<?= base_url("menu/hapus/$m->id"); ?>" onclick='return confirm("Hapus Menu \"<?= $m->nama; ?>\"?")' class="text-decoration-none text-white">
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