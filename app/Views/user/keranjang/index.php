<?= $this->extend('layouts/user') ?>
<?= $this->section('content') ?>
<div class="row mb-3">
    <div class="col-12">
        <h3>Keranjang</h3>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <?php
        App\Models\Flasher::flash();
        ?>
    </div>
</div>
<form action="/user/pesanan/add" method="post">
    <div class="row my-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Barang</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        foreach ($barangs as $i => $barang) {
                                            $subtotal = $barang['stock'] * $barang['barang_harga'];
                                            $total += $subtotal;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $i + 1 ?></td>
                                                <td><?= $barang['barang_name'] ?></td>
                                                <td class="text-center"><?= $barang['stock'] ?></td>
                                                <td class="text-center"><?= $barang['barang_harga'] ?></td>
                                                <td class="text-center"><?= $subtotal ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger" onclick="hapus(<?= $barang['keranjang_id'] ?>)">Hapus</button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <th colspan="4"><span class="float-right">Total</span></th>
                                            <th class="text-center">
                                                <?= $total ?>
                                            </th>
                                            <th></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(count($barangs)){
                    ?>
                    <div class="row mb-3">
                        <label for="pesanan_pembayaran" class="col-md-2 col-form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                        <div class="col-md-2">
                            <select name="pesanan_pembayaran" id="pesanan_pembayaran" class="form-control" required>
                                <option value="BNI">BNI</option>
                                <option value="BCA">BCA</option>
                                <option value="Gopay">Gopay</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="pesanan_total" value="<?=$total?>" >
                    <div class="row mb-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right">Checkout</button>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <form action="/user/keranjang/delete" method="post">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteModalLabel">Delete Barang
                    </h3>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="keranjang_id" id="keranjang_id">Apakah Anda yakin ingin menghapus barang ini dari keranjang?
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger float-right">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function hapus(keranjang_id) {
        $('#keranjang_id').val(keranjang_id);
        $('#deleteModal').modal('show');
    }
</script>
<?= $this->endSection() ?>