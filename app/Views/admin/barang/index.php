<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="row mb-3">
    <div class="col-12 col-md-6">
        <h3>Dashboard Barang</h3>
    </div>
    <div class="col-12 col-md-6">
        <a href="/admins/barang/add" class="btn btn-success btn-sm float-right">Tambah Barang</a>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <?php
                        App\Models\Flasher::flash();
                        ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Barang</th>
                                <th>Keterangan</th>
                                <th>Kategori</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($barangs as $i => $barang) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1 ?></td>
                                    <td><?= $barang['barang_name']; ?></td>
                                    <td><?= $barang['barang_remarks'] ?></td>
                                    <td><?= $barang['barang_kategori'] ?></td>
                                    <td class="text-center"><?= $barang['barang_harga'] ?></td>
                                    <td class="text-center"><?= $barang['barang_stock'] ?></td>
                                    <td class="text-center">
                                        <a href="/admins/barang/view/<?= $barang['barang_id'] ?>" class="btn btn-info btn-sm">View</a>
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
<?= $this->endSection() ?>