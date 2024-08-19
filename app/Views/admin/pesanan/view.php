<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="row mb-3">
    <div class="col-12">
        <h3>Pesanan</h3>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <?php
        App\Models\Flasher::flash();
        ?>
    </div>
</div>
<form action="/admins/pesanan/update" method="post">
    <input type="hidden" name="pesanan_id" value="<?= $pesanan['pesanan_id'] ?>">
    <div class="row my-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="pesanan_by" class="col-md-2 col-form-label">Pemesan <span class="text-danger">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="pesanan_by" class="form-control" id="pesanan_by" value="<?= $pesanan['username'] ?>" disabled>
                        </div>
                    </div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        foreach ($barangs as $i => $barang) {
                                            $subtotal = $barang['barang_jml'] * $barang['barang_harga'];
                                            $total += $subtotal;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $i + 1 ?></td>
                                                <td><?= $barang['barang_name'] ?></td>
                                                <td class="text-center"><?= $barang['barang_jml'] ?></td>
                                                <td class="text-center"><?= $barang['barang_harga'] ?></td>
                                                <td class="text-center"><?= $subtotal ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <th colspan="4"><span class="float-right">Total</span></th>
                                            <th class="text-center">
                                                <?= $total ?>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (count($barangs)) {
                    ?>
                        <div class="row mb-3">
                            <label for="pesanan_pembayaran" class="col-md-4 col-form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select name="pesanan_pembayaran" id="pesanan_pembayaran" class="form-control" required disabled>
                                    <option value="BNI" <?= $pesanan['pesanan_pembayaran'] == 'BNI' ? 'selected' : '' ?>>BNI</option>
                                    <option value="BCA" <?= $pesanan['pesanan_pembayaran'] == 'BCA' ? 'selected' : '' ?>>BCA</option>
                                    <option value="Gopay" <?= $pesanan['pesanan_pembayaran'] == 'Gopay' ? 'selected' : '' ?>>Gopay</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pesanan_path" class="col-md-4 col-form-label">Bukti Pembayaran <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <a href="/uploads/bukti/<?= $pesanan['pesanan_path'] ?>" download class="btn btn-success">Download</a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pesanan_status" class="col-md-4 col-form-label">Status Pesanan <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select name="pesanan_status" id="pesanan_status" class="form-control" required>
                                    <option value="0" <?= $pesanan['pesanan_status'] == '0' ? 'selected' : '' ?>>Belum Dibayar</option>
                                    <option value="1" <?= $pesanan['pesanan_status'] == '1' ? 'selected' : '' ?>>Menunggu Konfirmasi</option>
                                    <option value="2" <?= $pesanan['pesanan_status'] == '2' ? 'selected' : '' ?>>Menunggu Pengiriman</option>
                                    <option value="3" <?= $pesanan['pesanan_status'] == '3' ? 'selected' : '' ?>>Sedang Dikirim</option>
                                    <option value="4" <?= $pesanan['pesanan_status'] == '4' ? 'selected' : '' ?>>Sudah Diterima</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="pesanan_total" value="<?= $total ?>">
                        <div class="row mb-3">
                            <div class="col-12">
                                <a href="/admins/pesanan" class="btn btn-secondary float-left">Kembali</a>
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
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
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>