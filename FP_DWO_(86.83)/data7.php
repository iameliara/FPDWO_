<?php
include 'koneksi.php';

// Query untuk menghitung jumlah vendor per tahun
$query = "SELECT YEAR(OrderDate) AS Tahun, COUNT(DISTINCT VendorID) AS JumlahVendor
          FROM FactPurchaseOrder
          GROUP BY YEAR(OrderDate)";
$result = mysqli_query($conn, $query);

$vendor_per_tahun = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $vendor_per_tahun[] = [
            'Tahun' => $row['Tahun'],
            'JumlahVendor' => $row['JumlahVendor']
        ];
    }
} else {
    echo "Data tidak ditemukan.";
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($vendor_per_tahun);
?>
