<?= $this->extend('layouts/general') ?>
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
                <a href="/login" class="btn btn-sm btn-primary mb-2">Tambah Ke Keranjang</a>
                <a href="/login" class="btn btn-sm btn-success">Detail</a>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?= $this->endSection() ?>