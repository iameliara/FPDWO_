<?php
require('koneksi.php'); // Pastikan koneksi ke database sudah benar

// Query untuk mendapatkan daftar tanggal pesanan per vendor
$sql1 = "SELECT dv.VendorName, 
                fp.OrderDate AS Tanggal_Pesanan
         FROM factpurchaseorder fp
         JOIN dimvendor dv ON fp.VendorID = dv.VendorID
         ORDER BY dv.VendorName, fp.OrderDate;";

$result1 = mysqli_query($conn, $sql1);

$pesanan = array();

// Jika query berhasil, proses data
if ($result1) {
    while ($row = mysqli_fetch_assoc($result1)) {
        array_push($pesanan, array(
            "Tanggal_Pesanan" => $row['Tanggal_Pesanan'],
            "vendor" => $row['VendorName']
        ));
    }
} else {
    echo "Error in query: " . mysqli_error($conn);
    exit;
}

// Encode data sebagai JSON untuk digunakan di chart
$data3 = json_encode($pesanan);
?>
