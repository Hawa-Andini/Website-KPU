<?php
include "koneksi.php";

/* ========================= */
/* AMBIL DATA FORM */
/* ========================= */

$nip  = $_POST['nip'];
$nama = $_POST['nama_pegawai'];

$tempat_lahir  = ucwords($_POST['tempat_lahir']);
$tanggal_lahir = $_POST['tanggal_lahir'];

$jk     = $_POST['id_jenis_kelamin'];
$agama  = $_POST['id_agama'];
$status = $_POST['id_status_perkawinan'];
$unit   = $_POST['id_unit_kerja'];

$telp   = $_POST['no_telp'];
$alamat = $_POST['alamat'];

$tmt_cpns = $_POST['tmt_cpns'];
$tmt_pns  = $_POST['tmt_pns'];

$golongan = $_POST['id_gol'];
$tmt_gol  = $_POST['tmt_golongan'];

$jabatan = $_POST['id_jabatan'];
$tmt_jab = $_POST['tmt_jabatan'];


/* ========================= */
/* UPLOAD FOTO (OPSIONAL) */
/* ========================= */

$foto = $_FILES['foto']['name'];

if(!empty($foto)){

    $tmp  = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];

    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    if($ext != "jpg" && $ext != "jpeg"){
        echo "Foto harus format JPG / JPEG";
        exit;
    }

    if($size > 2000000){
        echo "Ukuran foto maksimal 2MB";
        exit;
    }

    move_uploaded_file($tmp,"foto/".$foto);

    $updateFoto = ", foto='$foto'";

}else{

    $updateFoto = "";

}


/* ========================= */
/* UPDATE DATA PEGAWAI */
/* ========================= */

mysqli_query($conn,"UPDATE pegawai SET
nama_pegawai='$nama',
tempat_lahir='$tempat_lahir',
tanggal_lahir='$tanggal_lahir',
alamat='$alamat',
tmt_cpns='$tmt_cpns',
tmt_pns='$tmt_pns',
no_telp='$telp',
id_jenis_kelamin='$jk',
id_agama='$agama',
id_status_perkawinan='$status',
id_gol='$golongan',
id_unit_kerja='$unit'
$updateFoto
WHERE nip='$nip'
");


/* ========================= */
/* SIMPAN RIWAYAT GOLONGAN */
/* ========================= */
if(!empty($golongan) && !empty($tmt_gol)){
    mysqli_query($conn,"INSERT INTO riwayat_golongan
    (
    nip,
    id_gol,
    tmt
    )
    VALUES
    (
    '$nip',
    '$golongan',
    '$tmt_gol'
    )");
}


/* ========================= */
/* SIMPAN RIWAYAT JABATAN */
/* ========================= */

if(!empty($jabatan) && !empty($tmt_jab)){
    mysqli_query($conn,"INSERT INTO riwayat_jabatan
    (
    nip,
    id_jabatan,
    tmt
    )
    VALUES
    (
    '$nip',
    '$jabatan',
    '$tmt_jab'
    )");
    }

/* ========================= */
/* KEMBALI KE HALAMAN PROFIL */
/* ========================= */

header("location:Identitas_User.php");

?>