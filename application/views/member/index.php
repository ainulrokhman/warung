<a href="<?= base_url('member/tambah'); ?>" class="btn btn-primary text-decoration-none">Tambah Member</a>

<div class="mt-3"><?php echo $this->session->flashdata('notify'); ?></div>
<hr>
<table id="example" class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Member</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($kategori as $k) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $k->nama; ?></td>
                <td><?= $k->hp; ?></td>
                <td><?= $k->alamat; ?></td>
                <td>
                    <a href="<?= base_url("member/ubah/$k->id"); ?>" class="text-decoration-none text-white">
                        <span class="badge bg-info"><i class="fas fa-edit"></i> Ubah</span>
                    </a>
                    <a href="<?= base_url("member/hapus/$k->id"); ?>" onclick='return confirm("Hapus member \"<?= $k->nama; ?>\"?")' class="text-decoration-none text-white">
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