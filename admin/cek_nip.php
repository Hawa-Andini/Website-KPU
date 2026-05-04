<?php
include '../config/koneksi.php';

$nip = $_POST['nip'];

$stmt = $conn->prepare("SELECT nip FROM pegawai WHERE nip = ?");
$stmt->bind_param("s", $nip);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "duplikat";
} else {
    echo "aman";
}