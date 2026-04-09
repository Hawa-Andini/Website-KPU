<?php
session_start();
include '../config/koneksi.php';

$limit = $_GET['limit'];
$page = $_GET['page'];
$search = mysqli_real_escape_string($conn, $_GET['search']);

$offset = ($page - 1) * $limit;

// 🔢 HITUNG TOTAL DATA
$totalQuery = mysqli_query($conn,"
SELECT COUNT(*) as total
FROM pegawai p
LEFT JOIN master_divisi md ON p.id_unit_kerja = md.id_unit_kerja
LEFT JOIN master_jabatan mj ON 1=1
LEFT JOIN master_golongan mg ON 1=1

WHERE 
p.nama_pegawai LIKE '%$search%' OR
p.nip LIKE '%$search%' OR
mj.nama_jabatan LIKE '%$search%' OR
mg.nama_pangkat LIKE '%$search%' OR
md.unit_kerja LIKE '%$search%'
");

$totalData = mysqli_fetch_assoc($totalQuery)['total'];
$totalPage = ceil($totalData / $limit);

// 🔍 DATA UTAMA
$query = mysqli_query($conn,"
SELECT 
p.nip,
p.nama_pegawai,
p.tipe_karyawan,
mj.nama_jabatan,
mg.nama_pangkat,
md.unit_kerja

FROM pegawai p

LEFT JOIN riwayat_jabatan rj 
ON rj.id_riwayat_jabatan = (
    SELECT id_riwayat_jabatan 
    FROM riwayat_jabatan 
    WHERE nip = p.nip 
    ORDER BY id_riwayat_jabatan DESC 
    LIMIT 1
)

LEFT JOIN master_jabatan mj 
ON rj.id_jabatan = mj.id_jabatan

LEFT JOIN riwayat_golongan rg 
ON rg.id_riwayat_gol = (
    SELECT id_riwayat_gol 
    FROM riwayat_golongan 
    WHERE nip = p.nip 
    ORDER BY id_riwayat_gol DESC 
    LIMIT 1
)

LEFT JOIN master_golongan mg 
ON rg.id_gol = mg.id_gol

LEFT JOIN master_divisi md
ON p.id_unit_kerja = md.id_unit_kerja

WHERE 
p.nama_pegawai LIKE '%$search%' OR
p.nip LIKE '%$search%' OR
mj.nama_jabatan LIKE '%$search%' OR
mg.nama_pangkat LIKE '%$search%' OR
md.unit_kerja LIKE '%$search%'

LIMIT $limit OFFSET $offset
");

$data = [];

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}

// 🔥 RETURN SEMUA
echo json_encode([
    "data" => $data,
    "totalPage" => $totalPage,
    "totalData" => $totalData
]);
