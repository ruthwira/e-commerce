<?= $this->extend('layouts/user') ?>
<?= $this->section('content') ?>
<div class="row mb-3">
    <div class="col-12">
        <h3>Detail Barang</h3>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <div class="col-12">
                        <?php
                        App\Models\Flasher::flash();
                        ?>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_name" class="col-md-2 col-form-label">Nama Barang <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="barang_name" id="barang_name" value="<?= $barang['barang_name'] ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_kategori" class="col-md-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="barang_kategori" id="barang_kategori" value="<?= $barang['barang_kategori'] ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_harga" class="col-md-2 col-form-label">Harga <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="barang_harga" id="barang_harga" value="<?= $barang['barang_harga'] ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_stock" class="col-md-2 col-form-label">Stock <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="barang_stock" id="barang_stock" value="<?= $barang['barang_stock'] ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_remarks" class="col-md-2 col-form-label">Keterangan <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <textarea name="barang_remarks" id="barang_remarks" cols="30" rows="10" class="form-control" disabled><?= $barang['barang_remarks'] ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_gambar" class="col-md-2 col-form-label">Gambar <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <?php
                            if ($barang['barang_gambar'] != '-') {
                            ?>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <img src="/uploads/barang/<?= $barang['barang_gambar'] ?>" alt="" class="img-responsive" style="width: 40vw;">
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <p class="text-muted">Belum ada foto</p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <a href="/user" class="btn btn-sm btn-secondary float-left">Kembali</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>