<?= $this->extend('layouts/user') ?>
<?= $this->section('content') ?>
<div class="row mb-3">
    <div class="col-12">
        <h3>Daftar Barang</h3>
    </div>
</div>
<div class="row mb-3">
    <?php
    foreach ($barangs as $i => $barang) {
    ?>
        <div class="card ml-3" style="width: 16rem;">
            <img src="/uploads/barang/<?= $barang['barang_gambar'] ?>" class="card-img-top" alt="...">
            <div class="card-body text-center">
                <h5 class="card-title mb-1"><?= $barang['barang_name']; ?></h5>
                <small> <?= $barang['barang_remarks'] ?> </small> <br>
                <span class="badge text-bg-success mb-3">Rp. <?= $barang['barang_harga'] ?></span>
                <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambahModal<?= $barang['barang_id'] ?>">Tambah Ke Keranjang</button>
                <a href="/user/barang/view/<?=$barang['barang_id']?>" class="btn btn-sm btn-success">Detail</a>
            </div>
        </div>
        <div class="modal fade" id="tambahModal<?= $barang['barang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="/user/keranjang/add" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambahkan Ke Keranjang</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="barang_id" value="<?= $barang['barang_id'] ?>">
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" id="stock" name="stock" placeholder="Stock" min="1" max="<?=$barang['barang_stock'];?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Tambah Ke Keranjang</button>
                        </div>
                    </div>
            </form>
        </div>
</div>
<?php
    }
?>
</div>

<?= $this->endSection() ?>