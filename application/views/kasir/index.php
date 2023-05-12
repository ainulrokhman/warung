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
                        <td class="text-end"><?= formatRupiah($m->harga); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col border p-3">
        <div class="mb-3 row">
            <label for="pembeli" class="col-sm-2 col-form-label">Pembeli</label>
            <div class="col-sm-10">
                <select class="form-control" id="pembeli" name="pembeli">
                    <option selected value="-1">Umum</option>
                    <option value="0">Member Baru</option>
                    <option value="2">Member 1</option>
                    <option value="3">Member 2</option>
                    <option value="4">Member 3</option>
                </select>
            </div>
        </div>
        <div id="data-pembeli" style="display: none;">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="nama" name="nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="hp" class="col-sm-2 col-form-label">No HP</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="hp" name="hp">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                </div>
            </div>
        </div>
        <hr class="mt-3">
        <!-- <div class="row">
            <div class="col">Menu</div>
            <div class="col">Quantity</div>
            <div class="col text-end">Total</div>
            <hr>
        </div> -->
        <div class="content">
        </div>
        <div class="row">
            <div class="col"><b>Sub Total</b></div>
            <div class="col text-end total">0</div>
        </div>
        <hr>
        <div class="row">
            <div class="col"><b>Jml. Bayar</b></div>
            <div class="col-4 text-end">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                    <input type="text" class="form-control" id="bayar" name="bayar">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col"><b>Kembali</b></div>
            <div class="col text-end" id="kembali"><?= formatRupiah(0); ?></div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="btn btn-primary form-control mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Bayar</div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
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
    });

    var dataTransaksi = {}

    $('#pembeli').on('change', function() {
        let value = $(this).val()
        let pembeli = document.getElementById("data-pembeli")
        if (value == 0) {
            pembeli.style.display = "block"
            return
        }
        pembeli.style.display = "none"
    })
    $('#bayar').on('change', function() {
        // let value = formatThousands($(this).val())
        let value = unformatThousands($(this).val())
        $(this).val(formatThousands(value))
        updateTotal()
    })

    var menus = Array();
    var subTotal = Array();
    $(document).on('change', '.qty', function() {
        var slug = $(this).data('slug');
        var harga = $(this).data('harga');
        var stok = $(this).data('stok');
        var qty = $(this).val()
        if (qty <= 0) {
            $(this).val(1)
            updateHarga(1, harga, slug)
        } else if (qty <= stok) {
            updateHarga(qty, harga, slug)
        } else {
            $(this).val(stok)
            updateHarga(stok, harga, slug)
        }
        updateTotal()
    })
    $('.menu').on('click', function() {
        var id = $(this).data('id')
        $.ajax({
            type: "POST",
            url: '<?= base_url('kasir/menu'); ?>',
            dataType: 'json',
            data: {
                "id": id
            },
            success: function(response) {
                let data = response['data']
                if (menus.indexOf(response['slug']) == -1) {
                    $('.content').append(response['html'])
                    menus.push(response['slug'])
                    subTotal[response['slug']] = parseInt(response['data']['harga'])
                } else {
                    var qty = parseInt($('.' + response['slug']).val())
                    var new_qty = qty + 1
                    if (new_qty <= response['data']['stok']) {
                        $('.' + response['slug']).val(new_qty)
                        updateHarga(new_qty, response['data']['harga'], response['slug'])
                    }
                }
                $('#bayar').val(formatThousands(total()))


                updateTotal()
            }
        })
    })

    function total() {
        let sum = 0;

        for (let value of Object.values(subTotal)) {
            sum += value;
        }

        return sum
    }

    function updateTotal() {
        let bayar = unformatThousands($("#bayar").val())
        let sum = total()
        let kembali = bayar - sum

        $("#kembali").html(formatThousands(kembali))
        $('.total').html(formatRupiah(sum))
    }

    function updateHarga(qty, harga, className) {
        var new_harga = harga * qty
        subTotal[className] = new_harga
        $('.harga-' + className).html(formatRupiah(new_harga))
    }

    function formatRupiah(number) {
        return number.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }

    function formatThousands(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function unformatThousands(formattedNumber) {
        return formattedNumber.replace(/\./g, "").replace(",", ".");
    }
</script>