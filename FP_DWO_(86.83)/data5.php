<?php
// Koneksi ke database
include 'koneksi.php';

// Query untuk mengambil data total order berdasarkan tahun
$query = "
    SELECT 
        YEAR(OrderDate) AS OrderYear, 
        SUM(OrderQty) AS TotalOrderQty, 
        SUM(LineTotal) AS TotalOrderValue
    FROM 
        factpurchaseorder
    GROUP BY 
        YEAR(OrderDate)
    ORDER BY 
        OrderYear
";

// Eksekusi query
$result = mysqli_query($conn, $query);

// Array untuk menyimpan data total order
$totalOrders = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $totalOrders[] = [
            'OrderYear' => $row['OrderYear'],
            'TotalOrderQty' => $row['TotalOrderQty'],
            'TotalOrderValue' => $row['TotalOrderValue']
        ];
    }
}

// Menampilkan data dalam format JSON
echo json_encode($totalOrders);
?>
