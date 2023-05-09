<div class="row">
    <div class="col border p-3">
        <table id="example" class="table">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($menu as $m) : ?>
                    <?php $kategori = $this->Model_Kategori->get_by_id($m->kategori_id)->row_array(); ?>
                    <tr class="menu" data-id="<?= $m->id; ?>">
                        <td>
                            <?= $m->nama; ?>
                            <br>
                            <div class="badge bg-info">Stok: <?= $m->stok; ?></div>
                        </td>
                        <td><?= $m->harga; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col border p-3">
        <div class="row">
            <div class="col">Menu</div>
            <div class="col">Quantity</div>
            <div class="col text-end">Total</div>
            <hr>
        </div>
        <div class="content">
        </div>
        <div class="row">
            <div class="col"><b>Sub Total</b></div>
            <div class="col text-end total">0</div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="btn btn-primary form-control mt-3 disabled">Bayar</div>
        </div>
    </div>
</div>

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
    var menus = Array();
    $(document).on('change', '.qty', function() {
        var slug = $(this).data('slug');
        var harga = $(this).data('harga');
        var stok = $(this).data('stok');
        var qty = $(this).val()
        if (qty <= 0) {
            // } else if (qty < 0) {
            $(this).val(1)
            updateHarga(1, harga, '.harga-' + slug)
        } else if (qty <= stok) {
            updateHarga(qty, harga, '.harga-' + slug)
        } else {
            $(this).val(stok)
            updateHarga(stok, harga, '.harga-' + slug)
        }
    })
    $('.menu').on('click', function() {
        var id = $(this).data('id')
        var total = parseInt($('.total').text())
        $.ajax({
            type: "POST",
            url: '<?= base_url('kasir/menu'); ?>',
            dataType: 'json',
            data: {
                "id": id
            },
            success: function(response) {
                var subTotal = total + +response['data']['harga']
                if (menus.indexOf(response['slug']) == -1) {
                    $('.content').append(response['html'])
                    $('.total').html(subTotal)
                    menus.push(response['slug'])
                } else {
                    var qty = parseInt($('.' + response['slug']).val())
                    var new_qty = qty + 1
                    if (new_qty <= response['data']['stok']) {
                        $('.' + response['slug']).val(new_qty)
                        updateHarga(new_qty, response['data']['harga'], '.harga-' + response['slug'])
                    }
                }
            }
        })
    })

    function updateHarga(qty, harga, className) {
        var new_harga = harga * qty
        $(className).html(new_harga)
    }
</script>