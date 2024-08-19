<?= $this->extend('layouts/user') ?>
<?= $this->section('content') ?>
<div class="row mb-3">
    <div class="col-12">
        <h3>Daftar Pesanan</h3>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <?php
        App\Models\Flasher::flash();
        ?>
    </div>
</div>
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
                                        <th>Tanggal</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pesanans as $i => $pesanan) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $i + 1 ?></td>
                                            <td><?= $pesanan['created_at'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                    if($pesanan['pesanan_status'] == 0){
                                                        echo '<span class="badge badge-pill badge-danger">Belum Dibayar</span>';
                                                    }
                                                    if($pesanan['pesanan_status'] == 1){
                                                        echo '<span class="badge badge-pill badge-warning">Menunggu Konfirmasi</span>';
                                                    }
                                                    if($pesanan['pesanan_status'] == 2){
                                                        echo '<span class="badge badge-pill badge-info">Menunggu Pengiriman</span>';
                                                    }
                                                    if($pesanan['pesanan_status'] == 3){
                                                        echo '<span class="badge badge-pill badge-primary">Sedang Dikirim</span>';
                                                    }
                                                    if($pesanan['pesanan_status'] == 4){
                                                        echo '<span class="badge badge-pill badge-success">Sudah Diterima</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="/user/pesanan/view/<?=$pesanan['pesanan_id']?>" class="btn btn-info">Lihat</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>