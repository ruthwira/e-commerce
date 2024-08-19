<?= $this->extend('layouts/user') ?>
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
<form action="/user/pesanan/update" method="post" enctype="multipart/form-data">
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
                            <label for="pesanan_pembayaran" class="col-md-2 col-form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                            <div class="col-md-2">
                                <select name="pesanan_pembayaran" id="pesanan_pembayaran" class="form-control" required disabled>
                                    <option value="BNI" <?= $pesanan['pesanan_pembayaran'] == 'BNI' ? 'selected' : '' ?>>BNI</option>
                                    <option value="BCA" <?= $pesanan['pesanan_pembayaran'] == 'BCA' ? 'selected' : '' ?>>BCA</option>
                                    <option value="Gopay" <?= $pesanan['pesanan_pembayaran'] == 'Gopay' ? 'selected' : '' ?>>Gopay</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pesanan_status" class="col-md-2 col-form-label">Status Pesanan <span class="text-danger">*</span></label>
                            <div class="col-md-2">
                                <?php
                                if ($pesanan['pesanan_status'] == 0) {
                                    echo '<span class="badge badge-pill badge-danger">Belum Dibayar</span>';
                                }
                                if ($pesanan['pesanan_status'] == 1) {
                                    echo '<span class="badge badge-pill badge-warning">Menunggu Konfirmasi</span>';
                                }
                                if ($pesanan['pesanan_status'] == 2) {
                                    echo '<span class="badge badge-pill badge-info">Menunggu Pengiriman</span>';
                                }
                                if ($pesanan['pesanan_status'] == 3) {
                                    echo '<span class="badge badge-pill badge-primary">Sedang Dikirim</span>';
                                }
                                if ($pesanan['pesanan_status'] == 4) {
                                    echo '<span class="badge badge-pill badge-success">Sudah Diterima</span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pesanan_path" class="col-md-2 col-form-label">Bukti Pembayaran <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <?php
                                if ($pesanan['pesanan_status'] == 0) {
                                ?>
                                    <input type="file" name="pesanan_path" id="pesanan_path" class="form-control" required>
                                <?php
                                } else {
                                ?>
                                    <a href="/uploads/bukti/<?= $pesanan['pesanan_path'] ?>" download class="btn btn-success">Download</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <input type="hidden" name="pesanan_total" value="<?= $total ?>">
                        <div class="row mb-3">
                            <div class="col-12">
                                <a href="/user/pesanan" class="btn btn-secondary float-left">Kembali</a>
                                <?php
                                if ($pesanan['pesanan_status'] == 0) {
                                ?>
                                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                <?php
                                } else if ($pesanan['pesanan_status'] == 3) {
                                ?>
                                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#confirmModal">Konfirmasi Diterima</button>
                                <?php
                                }
                                ?>
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
<!-- Logout Modal-->
<form action="/user/pesanan/konfirmasi" method="post">
    <input type="hidden" name="pesanan_id" value="<?=$pesanan['pesanan_id']?>">
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Diterima</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda yakin ingin mengkonfirmasi bahwa pesanan sudah diterima?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>