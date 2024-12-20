<?php
// Koneksi ke database
include 'koneksi.php';

// Query untuk mengambil data lokasi dan mengurutkan berdasarkan CostRate dari yang tertinggi ke terendah
$query = "SELECT LocationID, LocationName, CostRate, Availability FROM dimlocation ORDER BY CostRate DESC";

// Eksekusi query
$result = mysqli_query($conn, $query);

// Array untuk menyimpan data lokasi
$locations = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $locations[] = [
            'LocationID' => $row['LocationID'],
            'LocationName' => $row['LocationName'],
            'CostRate' => $row['CostRate'],
            'Availability' => $row['Availability']
        ];
    }
}

// Menampilkan data dalam format JSON
echo json_encode($locations);
?>
