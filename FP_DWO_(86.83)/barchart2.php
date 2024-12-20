<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Vendor</title>

    <!-- Custom fonts and styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,900" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleGraph.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
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
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .chart-title {
            text-align: center;
            font-size: 2rem;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }
    </style>
</head>

<body id="page-top">

<?php 
include 'data4.php'; // Pastikan file ini mengembalikan $data3 yang berisi JSON
$data3 = json_decode($data3, TRUE);
?>

<div id="wrapper">
<?php include "sidebar.php";?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container">
                <h1 class="chart-title">Data Pesanan Vendor Berdasarkan Tanggal</h1>
                <div id="barchart" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Dashboard Vendor 2024</span>
                </div>
            </div>
        </footer>
    </div>

</div>

<script>
    const data3 = <?= json_encode($data3); ?>;

    if (data3.length === 0) {
        console.error("Tidak ada data untuk grafik.");
    } else {
        const groupedData = {};
        data3.forEach(item => {
            if (!groupedData[item.vendor]) {
                groupedData[item.vendor] = [];
            }
            groupedData[item.vendor].push(item.Tanggal_Pesanan);
        });

        const seriesData = Object.keys(groupedData).map(vendor => ({
            name: vendor,
            data: groupedData[vendor].map(date => {
                const parsedDate = Date.parse(date);
                return [parsedDate, 1]; // Mengubah ke timestamp
            }),
        }));

        Highcharts.chart('barchart', {
            chart: {
                type: 'line',
                backgroundColor: '#f9f9f9',
            },
            title: {
                text: 'Data Pesanan Vendor Berdasarkan Tanggal',
            },
            xAxis: {
                type: 'datetime',
                title: { text: 'Tanggal' },
            },
            yAxis: {
                title: { text: 'Jumlah Pesanan' },
            },
            series: seriesData,
            tooltip: {
                xDateFormat: '%d %b %Y',
                shared: true,
            },
            credits: { enabled: false },
        });
    }
</script>

</body>

</html>
