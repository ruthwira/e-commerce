<!-- admin/index.php -->

<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <!-- Bagian Total Member -->
        <div class="col-md-4 order-md-1">
            <div class="mini-stat clearfix bg-primary text-center">
                <span class="font-40 text-white mb-2"><i class="mdi mdi-account-multiple"></i></span>
                <div class="mini-stat-info mt-2">
                    <span style="font-size: small;" class="text-white">Total Member</span>
                </div>
                <div class="clearfix"></div>
                <p class="mb-3 m-t-10 text-muted">
                    </p><h4 class="counter font-light mt-0 text-white"><?= $total_users ?> User</h4>
                <p></p>
            </div>
        </div>

        <!-- Bagian Total Barang -->
        <div class="col-md-4">
            <p>Total Barang: <?= $total_barang ?></p>
            <!-- Tambahkan elemen HTML untuk grafik total barang -->
            <canvas id="myChartBarang" width="100" height="100"></canvas>
        </div>

        <!-- Bagian Total Order Per Bulan -->
        <div class="col-md-4">
            <p>Total Orders Per Bulan</p>
            <canvas id="myChartOrders" width="100" height="100"></canvas>
        </div>
    </div>
</div>

<!-- Tambahkan script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil data dari controller atau model untuk digunakan dalam grafik
        var totalBarang = <?= $total_barang ?>;
        var totalOrdersPerMonth = <?= json_encode($total_orders_per_month) ?>;

        // Buat array untuk menyimpan data bulan dan total order
        var labelsBarang = ['Total Barang'];
        var dataBarang = [totalBarang];

        var labelsOrders = [];
        var dataOrders = [];

        // Loop melalui hasil totalOrdersPerMonth dan memisahkan bulan dan total order
        for (var i = 0; i < totalOrdersPerMonth.length; i++) {
            labelsOrders.push('Bulan ' + totalOrdersPerMonth[i].month);
            dataOrders.push(totalOrdersPerMonth[i].total);
        }

        // Buat data untuk grafik total barang
        var ctxBarang = document.getElementById('myChartBarang').getContext('2d');
        var myChartBarang = new Chart(ctxBarang, {
            type: 'bar',
            data: {
                labels: labelsBarang,
                datasets: [{
                    label: 'Total Barang',
                    data: dataBarang,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Buat data untuk grafik total order per bulan
        var ctxOrders = document.getElementById('myChartOrders').getContext('2d');
        var myChartOrders = new Chart(ctxOrders, {
            type: 'bar',
            data: {
                labels: labelsOrders,
                datasets: [{
                    label: 'Total Orders',
                    data: dataOrders,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
