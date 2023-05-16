<div class="mt-3"><?php echo $this->session->flashdata('notify'); ?></div>
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
                    <?php $kategori = $this->ModelKategori->get_by_id($m->kategori_id)->row_array(); ?>
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
        <form action="" method="post">
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
                        <input required disabled type="text" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="hp" class="col-sm-2 col-form-label">No HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="hp" name="hp">
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
            <div class="content">
            </div>
            <div class="row">
                <div class="col"><b>Sub Total</b></div>
                <!-- <div class="col text-end total">0</div> -->
                <div class="col">
                    <input type="text" class="form-control-plaintext text-end total" name="total" value="<?= formatRupiah(0); ?>">
                </div>
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
                <div class="col">
                    <input type="text" class="form-control-plaintext text-end" name="kembali" id="kembali" value="<?= formatRupiah(0); ?>">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary form-control mt-3">Bayar</button>
            </div>
        </form>
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
        $('#example').DataTable({
            order: [
                [0, 'asc']
            ],
        });
    });
    $(document).on('submit', 'form', function() {
        const qty = $('.qty').val()
        if (!qty) {
            alert("Masukan menu pesanan terlebih dahulu")
            return false
        }

        const kembali = $('#kembali').val()
        const pembeli = $('#pembeli').val()
        if (kembali.includes("-") && pembeli.includes("-")) {
            alert("Pilih pembeli untuk pembayaran yang kurang")
            return false;
        }
    });

    let dataTransaksi = {}

    $('#pembeli').on('change', function() {
        const value = $(this).val()
        const pembeli = document.getElementById("data-pembeli")
        if (value == 0) {
            pembeli.style.display = "block"
            $("#nama").prop("disabled", false)
            return
        }
        $("#nama").prop("disabled", true)
        pembeli.style.display = "none"
    })
    $('#bayar').on('input', function() {
        const value = unformatThousands($(this).val())
        $(this).val(formatThousands(value))
        updateTotal()
    })

    const subTotal = Array();
    $(document).on('click', '.hapus', function() {
        $(this).parent().parent().remove()
        const slug = $(this).data("slug")
        delete subTotal[slug]

        $('#bayar').val(formatThousands(total()))
        updateTotal()
    })

    $(document).on('input', '.qty', function() {
        const slug = $(this).data('slug');
        const harga = $(this).data('harga');
        const stok = $(this).data('stok');
        const qty = $(this).val()
        if (qty < 0) {
            $(this).val(1)
            updateHarga(1, harga, slug)
        } else if (qty <= stok) {
            updateHarga(qty, harga, slug)
        } else {
            $(this).val(stok)
            updateHarga(stok, harga, slug)
        }

        $('#bayar').val(formatThousands(total()))
        updateTotal()
    })
    $('.menu').on('click', function() {
        const id = $(this).data('id')
        $.ajax({
            type: "POST",
            url: '<?= base_url('kasir/menu'); ?>',
            dataType: 'json',
            data: {
                "id": id
            },
            success: function(response) {
                let data = response['data']
                if (!subTotal[response['slug']]) {
                    $('.content').append(response['html'])
                    subTotal[response['slug']] = parseInt(response['data']['harga'])
                } else {
                    const qty = parseInt($('.' + response['slug']).val())
                    let new_qty = qty + 1
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

        $("#kembali").val(formatRupiah(kembali))
        $('.total').val(formatRupiah(sum))
    }

    function updateHarga(qty, harga, className) {
        let new_harga = harga * qty
        subTotal[className] = new_harga
        $('.harga-' + className).html(formatRupiah(new_harga))
    }

    function formatRupiah(number) {
        const formatNumber = number.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
        const replacedNumber = formatNumber.replace(/\u00A0/g, ' ');

        return replacedNumber;
    }

    function formatThousands(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // function unformatThousands(formattedNumber) {
    //     // return formattedNumber.replace(/\./g, "").replace(",", ".", "Rp");
    //     // const unformattedValue = formattedNumber.replace(/[,.]/g, '');
    //     // return parseFloat(unformattedValue);
    //     return formattedNumber.replace(/\D/g, '');
    // }

    function unformatThousands(rupiah) {
        const regex = /-?([\d.,]+)/;
        const matches = rupiah.match(regex);
        if (matches && matches.length > 0) {
            const formattedNumber = matches[0].replace(/[,.]/g, '');
            return parseFloat(formattedNumber);
        }
        return NaN;
    }
</script>