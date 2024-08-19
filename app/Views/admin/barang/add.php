<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="row mb-3">
    <div class="col-12">
        <h3>Tambah Barang</h3>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="/admins/barang/add" method="post" enctype="multipart/form-data">
                    <div class="col-12">
                        <?php
                        App\Models\Flasher::flash();
                        ?>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_name" class="col-md-2 col-form-label">Nama Barang <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="barang_name" id="barang_name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_kategori" class="col-md-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="barang_kategori" id="barang_kategori" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_harga" class="col-md-2 col-form-label">Harga <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="barang_harga" id="barang_harga" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_stock" class="col-md-2 col-form-label">Stock <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="barang_stock" id="barang_stock" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_remarks" class="col-md-2 col-form-label">Keterangan <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <textarea name="barang_remarks" id="barang_remarks" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_gambar" class="col-md-2 col-form-label">Gambar <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="file" name="barang_gambar" id="barang_gambar" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <a href="/admins/barang" class="btn btn-sm btn-secondary float-left">Kembali</a>
                            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</submit>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>