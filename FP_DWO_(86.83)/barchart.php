<?php
// Include database connection
include 'koneksi.php';

// Fetch data from data2.php
$data2 = file_get_contents('data2.php');  // This gets the JSON data from data2.php

// Check if data is available and decode JSON
if (empty($data2)) {
    echo "Data not found.";
} else {
    $locations = json_decode($data2, TRUE);  // Decode JSON to an associative array
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Lokasi</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .chart-title {
            text-align: center;
            font-size: 2rem;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .highcharts-description {
            font-size: 1rem;
            color: #666;
            text-align: center;
            margin-top: 20px;
            padding: 0 15px;
        }

        footer {
            background-color: #f8f9fc;
            padding: 15px 0;
            font-size: 0.875rem;
        }

        footer .copyright {
            color: #6c757d;
        }

        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #00aaff;
            color: white;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            z-index: 1000;
        }

        .scroll-to-top:hover {
            background-color: #007bb5;
        }
    </style>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include "sidebar.php";?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container">
                <h1 class="chart-title">Lokasi dengan Cost Rate Tertinggi</h1>
                <div id="barchart" style="width: 100%; height: 500px;"></div>
                <p class="highcharts-description">
                    Grafik ini menampilkan Lokasi dengan Cost Rate Tertinggi berdasarkan data yang tersedia.
                </p>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Dashboard Lokasi 2024</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Mengambil data lokasi dan CostRate
    $.get("data2.php", function(data) {
        const vendorData = JSON.parse(data); // Parsing data JSON
        let vendorNames = [];
        let costRates = [];

        // Loop untuk menyiapkan data untuk grafik
        vendorData.forEach(vendor => {
            vendorNames.push(vendor.LocationName);  // Nama lokasi
            costRates.push(parseFloat(vendor.CostRate));  // CostRate lokasi
        });

        // Membuat grafik bar dengan Highcharts
        Highcharts.chart('barchart', {
            chart: {
                type: 'bar'  // Jenis grafik: bar chart
            },
            title: {
                text: 'Lokasi dengan Cost Rate Tertinggi'
            },
            xAxis: {
                categories: vendorNames  // Menampilkan nama lokasi di sumbu X
            },
            yAxis: {
                title: {
                    text: 'Cost Rate'
                }
            },
            series: [{
                name: 'Cost Rate',
                data: costRates  // Data cost rate untuk grafik
            }]
        });
    });
</script>

<!-- Bootstrap core JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js"></script>

</body>

</html>
