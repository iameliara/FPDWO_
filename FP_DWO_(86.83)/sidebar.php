<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard AW Mekdi</title>

    <!-- Custom fonts and styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
        }

        .sidebar {
            background: linear-gradient(180deg, #ff69b4 0%, #ff1493 100%);
            color: #fff;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #fff;
            font-weight: 600;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 5px;
        }

        .sidebar .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            margin: 1rem 0;
            color: #fff;
        }

        .sidebar .sidebar-heading {
            font-size: 0.9rem;
            text-transform: uppercase;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2rem;
        }

        .container-fluid {
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #ff6347;
            font-weight: 700;
        }

        p {
            color: #6c757d;
            line-height: 1.7;
        }

        footer {
            background: #ffffff;
            padding: 1rem 0;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .btn-primary {
            background-color: #ff1493;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ff69b4;
        }

        .scroll-to-top {
            background-color: #ff1493;
        }

        .scroll-to-top:hover {
            background-color: #ff69b4;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper" class="d-flex">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="sidebar-brand-text mx-3">MELOR</div>
            </a>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Grafik Data</div>
            <li class="nav-item">
                <a class="nav-link" href="linechart.php">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Penjualan Terbanyak</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="linechart2.php">
                    <i class="far fa-clock"></i>
                    <span>Vendor Tiap Tahun</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="barchart.php">
                    <i class="fas fa-money-bill"></i>
                    <span>Cost Rate Tertinggi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="barchart2.php">
                    <i class="fas fa-tasks"></i>
                    <span>Pesanan Berdasarkan Tanggal</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="donatchart.php">
                    <i class="fas fa-money-bill-alt"></i>
                    <span>Total Order Pada Tahun</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">OLAP</div>
            <li class="nav-item">
                <a class="nav-link" href="olap.php">
                    <i class="fas fa-database"></i>
                    <span>Mondrian</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>

       <!-- Content -->
<div id="content-wrapper" class="flex-grow-1 d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="text-center">
        <h2>✨ Halo Guyss! ✨</h2>
        <p>Selamat datang di Dashboard <strong>keren</strong> buatan <span style="color: #007bff;">Amel</span> dan <span style="color: #28a745;">Ammor</span>!</p>
        <p>Dashboard ini menyajikan berbagai <strong>grafik interaktif</strong> berbasis data dari <span style="color: #ffc107;">database aw_mekdi</span>, yang diambil dari database AdventureWorks. Juga tersedia <strong>tampilan OLAP</strong> yang diintegrasikan dengan <span style="color: #17a2b8;">Mondrian</span> untuk analisis lebih mendalam.</p>
    </div>
    <footer class="position-absolute bottom-0 w-100 text-center">
        <span>Copyright &copy; Dashboard Amel-Ammor</span>
    </footer>
</div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
