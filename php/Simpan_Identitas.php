<?php
include "koneksi.php";

/* AMBIL DATA FORM */
$nip  = $_POST['nip'];
$nama = $_POST['nama_pegawai'];

$instansi = "KPU Kota Surabaya";
$tipe_karyawan = $_POST['tipe_karyawan'];

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


//* UPLOAD FOTO  */
$updateFoto = "";
if (!empty($_FILES['foto']['name'])) {

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];

    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    if ($ext != "jpg" && $ext != "jpeg") {
        echo "Foto harus format JPG / JPEG";
        exit;
    }

    if ($size > 1000000) {
        echo "Ukuran foto maksimal 1MB";
        exit;
    }

    $namaBaru = time() . "_" . $foto;

    move_uploaded_file($tmp, "../uploads/" . $namaBaru);
    
    mysqli_query($conn, "UPDATE pegawai SET foto='uploads/$namaBaru' WHERE nip='$nip'");
}

/* UPDATE DATA PEGAWAI */
mysqli_query($conn,"UPDATE pegawai SET
nama_pegawai='$nama',
instansi='$instansi',
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
id_unit_kerja='$unit',
tipe_karyawan='$tipe_karyawan'
$updateFoto
WHERE nip='$nip'
");

/* SIMPAN RIWAYAT GOLONGAN */
if(!empty($golongan) && !empty($tmt_gol)){
    mysqli_query($conn,"INSERT INTO riwayat_golongan
    (
    nip,
    id_gol,
    tmt_golongan
    )
    VALUES
    (
    '$nip',
    '$golongan',
    '$tmt_gol'
    )");
}

/* HAPUS DATA PEGAWAI */
if(isset($_POST['hapus'])){

    $nip = $_POST['nip'];

    mysqli_query($conn,"DELETE FROM pegawai WHERE nip='$nip'");

    exit;
}

/* SIMPAN RIWAYAT JABATAN */
if(!empty($jabatan) && !empty($tmt_jab)){

    $id_unit_kerja = $_POST['id_unit_kerja'];
    
    mysqli_query($conn,"INSERT INTO riwayat_jabatan
    (
    nip,
    id_jabatan,
    id_unit_kerja,
    tmt_jabatan
    )
    VALUES
    (
    '$nip',
    '$jabatan',
    '$id_unit_kerja',
    '$tmt_jab'
    )");

}

header("location:Edit_Identitas_User.php");

?>