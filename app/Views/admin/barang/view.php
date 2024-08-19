<?= $this->extend('layouts/admin') ?>
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
                <form action="/admins/barang/update" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="barang_id" id="barang_id" value="<?= $barang['barang_id'] ?>">
                    <div class="col-12">
                        <?php
                        App\Models\Flasher::flash();
                        ?>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_name" class="col-md-2 col-form-label">Nama Barang <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="barang_name" id="barang_name" value="<?= $barang['barang_name'] ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_kategori" class="col-md-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="barang_kategori" id="barang_kategori" value="<?= $barang['barang_kategori'] ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_harga" class="col-md-2 col-form-label">Harga <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="barang_harga" id="barang_harga" value="<?= $barang['barang_harga'] ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_stock" class="col-md-2 col-form-label">Stock <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="barang_stock" id="barang_stock" value="<?= $barang['barang_stock'] ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_remarks" class="col-md-2 col-form-label">Keterangan <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <textarea name="barang_remarks" id="barang_remarks" cols="30" rows="10" class="form-control" required><?=$barang['barang_remarks']?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="barang_gambar" class="col-md-2 col-form-label">Gambar <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <?php
                                if($barang['barang_gambar'] != '-'){
                            ?>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <img src="/uploads/barang/<?=$barang['barang_gambar']?>" alt="" class="img-responsive" style="width: 40vw;">
                                </div>
                            </div>
                            <?php
                                }else{
                            ?>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <p class="text-muted">Belum ada foto</p>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            <input type="file" name="barang_gambar" id="barang_gambar" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <a href="/admins/barang" class="btn btn-sm btn-secondary float-left">Kembali</a>
                            <a href="/admins/barang/delete/<?=$barang['barang_id']?>" class="btn btn-sm btn-danger float-right" onclick=" return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</a>
                            <button type="submit" class="btn btn-sm btn-primary float-right mr-2">Simpan</submit>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>