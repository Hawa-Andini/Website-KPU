<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

include 'koneksi.php';

// ==========================
// AMBIL NIP
// ==========================
if(isset($_GET['nip'])){
    $nip = mysqli_real_escape_string($conn, $_GET['nip']);
}else{
    die("NIP tidak ditemukan.");
}

// ==========================
// DATA PEGAWAI
// ==========================
$query = mysqli_query($conn, "
SELECT * FROM pegawai WHERE nip='$nip'
");
$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data tidak ditemukan.");
}

// ==========================
// GOLONGAN TERAKHIR
// ==========================
$data_gol = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT rg.*, mg.nama_pangkat, mg.kode_gol
FROM riwayat_golongan rg
JOIN master_golongan mg ON rg.id_gol = mg.id_gol
WHERE rg.nip='$nip'
ORDER BY rg.tmt_golongan DESC
LIMIT 1
"));

// ==========================
// JABATAN TERAKHIR
// ==========================
$data_jabatan_all = mysqli_query($conn,"
SELECT rj.*, mj.jenis_jabatan, mj.nama_jabatan
FROM riwayat_jabatan rj
JOIN master_jabatan mj ON rj.id_jabatan = mj.id_jabatan
WHERE rj.nip='$nip'
ORDER BY rj.tmt_jabatan DESC
");

// ==========================
// QUERY RIWAYAT
// ==========================
$golongan = mysqli_query($conn, "
SELECT rg.*, mg.kode_gol, mg.nama_pangkat
FROM riwayat_golongan rg
JOIN master_golongan mg ON rg.id_gol = mg.id_gol
WHERE rg.nip='$nip'
ORDER BY rg.tmt_golongan DESC
");

$jabatan = mysqli_query($conn, "
SELECT rj.*, mj.nama_jabatan
FROM riwayat_jabatan rj
JOIN master_jabatan mj ON rj.id_jabatan = mj.id_jabatan
WHERE rj.nip='$nip'
");

$pendidikan = mysqli_query($conn, "
SELECT * FROM riwayat_pendidikan WHERE nip='$nip'
");

$diklat = mysqli_query($conn, "
SELECT * FROM riwayat_diklat WHERE nip='$nip'
");

// ==========================
// HTML
// ==========================
$html = '
<style>
body{ font-family: Arial; font-size:12px; }
.container{ border:1px solid black; padding:10px; }
.title{ text-align:center; font-weight:bold; margin-bottom:10px; }
.box{ border:1px solid black; padding:8px; margin:5px; }
.row{ width:100%; }
.col{ width:48%; display:inline-block; vertical-align:top; }
</style>

<div class="title">PROFIL PEGAWAI NEGERI SIPIL</div>

<div class="container">

<div class="row">

<div style="width:30%; height:120px; border:1px solid black; display:inline-block; text-align:center;">
<br><br>FOTO
</div>

<div style="width:65%; border:1px solid black; display:inline-block; padding:5px;">
<b>IDENTITAS</b><br><br>

Nama : '.$data['nama_pegawai'].'<br>
NIP : '.$data['nip'].'<br>

Pangkat / Gol :
'.($data_gol['nama_pangkat'] ?? '-').' ('.($data_gol['kode_gol'] ?? '-').') / 
'.(isset($data_gol['tmt_golongan']) ? date('d-m-Y', strtotime($data_gol['tmt_golongan'])) : '-').'<br>

Jabatan :
'.($data_jabatan['nama_jabatan'] ?? '-').' - '.($data_jabatan['jenis_jabatan'] ?? '-').' / 
'.(isset($data_jabatan['tmt_jabatan']) ? date('d-m-Y', strtotime($data_jabatan['tmt_jabatan'])) : '-').'<br>

TMT CPNS : '.(!empty($data['tmt_cpns']) ? date('d-m-Y', strtotime($data['tmt_cpns'])) : '-').'<br>
TMT PNS : '.(!empty($data['tmt_pns']) ? date('d-m-Y', strtotime($data['tmt_pns'])) : '-').'<br>

TTL : '.$data['tempat_lahir'].', '.date('d-m-Y', strtotime($data['tanggal_lahir'])).'<br>

Jenis Kelamin : '.$data['jenis_kelamin'].'<br>
Agama : '.$data['agama'].'<br>
Status : '.$data['status_perkawinan'].'<br>
Unit Kerja : '.$data['unit_kerja'].'<br>
No HP : '.$data['no_telp'].'<br>

Alamat : '.$data['alamat'].'

</div>
</div>
';

// ==========================
// RIWAYAT GOLONGAN
// ==========================
$html .= '
<div class="row">
<div class="col box">
<b>RIWAYAT GOLONGAN</b><br><br>
';

while($g = mysqli_fetch_assoc($golongan)){
    $html .= $g['kode_gol'].' - '.$g['nama_pangkat'].' / '.date('d-m-Y', strtotime($g['tmt_golongan'])).'<br>';
}

// ==========================
// RIWAYAT JABATAN
// ==========================
$html .= '
</div>

<div class="col box">
<b>RIWAYAT JABATAN</b><br><br>
';

while($row = mysqli_fetch_assoc($data_jabatan_all)){
    $html .= '
    '.$row['jenis_jabatan'].' - '.$row['nama_jabatan'].' / 
    '.date('d-m-Y', strtotime($row['tmt_jabatan'])).'<br>
    ';
}

$html .= '
</div>
</div>
';

// ==========================
// ROW 2
// ==========================
$html .= '
<div class="row">

<div class="col box">
<b>RIWAYAT PENDIDIKAN</b><br><br>
';

while($p = mysqli_fetch_assoc($pendidikan)){
    $html .= $p['nama_pendidikan'].'<br>';
}

$html .= '
</div>

<div class="col box">
<b>RIWAYAT DIKLAT</b><br><br>
';

while($d = mysqli_fetch_assoc($diklat)){
    $html .= $d['nama_diklat'].'<br>';
}

$html .= '
</div>

</div>

</div>
';

// ==========================
// PDF
// ==========================
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream("profil_pegawai.pdf", ["Attachment"=>false]);
?>