<a href="<?= base_url('transaksi/tambah'); ?>" class="btn btn-primary text-decoration-none">Tambah Member</a>

<div class="mt-3"><?php echo $this->session->flashdata('notify'); ?></div>
<hr>
<table id="example" class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>No Invoice</th>
            <th>Tanggal</th>
            <!-- <th>Alamat</th> -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($kategori as $k) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $k->invoice; ?></td>
                <td><?= $k->waktu; ?></td>
                <!-- <td><?= $k->alamat; ?></td> -->
                <td>
                    <a data-id="<?= $k->id; ?>" role="button" class="text-decoration-none text-white detail" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span class="badge bg-info"><i class="fas fa-search"></i> Detail</span>
                    </a>
                    <a href="<?= base_url("transaksi/hapus/$k->id"); ?>" onclick='return confirm("Hapus member \"<?= $k->invoice; ?>\"?")' class="text-decoration-none text-white">
                        <span class="badge bg-danger"><i class="fas fa-trash"></i> Hapus</span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $(".detail").on("click", function() {
            const id = $(this).data("id")
            $.ajax({
                type: "POST",
                url: '<?= base_url('transaksi'); ?>',
                dataType: 'json',
                data: {
                    "id": id
                },
                success: function(response) {
                    console.log(response);
                }
            })
        })
    });
</script>