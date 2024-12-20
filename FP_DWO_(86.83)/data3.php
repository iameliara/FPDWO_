<?php
require('koneksi.php'); // Pastikan koneksi ke database sudah benar

// Query untuk mendapatkan total pendapatan per vendor
$sql1 = "SELECT dv.VendorName, 
       SUM(fp.LineTotal) AS total_pendapatan
FROM factpurchaseorder fp
JOIN dimvendor dv ON fp.VendorID = dv.VendorID
GROUP BY dv.VendorName
ORDER BY total_pendapatan DESC;
";

$result1 = mysqli_query($conn, $sql1);

$pendapatan = array();

// Jika query berhasil, proses data
if ($result1) {
    while ($row = mysqli_fetch_array($result1)) {
        array_push($pendapatan, array(
            "total_pendapatan" => $row['total_pendapatan'],
            "vendor" => $row['VendorName']
        ));
    }
} else {
    echo "Error in query: " . mysqli_error($conn);
    exit;
}

// Encode data sebagai JSON untuk digunakan di chart
$data3 = json_encode($pendapatan);
?>
