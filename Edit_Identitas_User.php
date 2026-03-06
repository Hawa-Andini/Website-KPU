<?php
session_start();   
include "koneksi.php";

if(!isset($_SESSION['nip'])){
    header("location:Login.php");
    exit;
}

$nip = $_SESSION['nip'];

$query = mysqli_query($conn,"SELECT * FROM pegawai WHERE nip='$nip'");
$data = mysqli_fetch_assoc($query);

$riwayat_gol = mysqli_query($conn,"
SELECT * FROM riwayat_golongan
WHERE nip='$nip'
ORDER BY tmt DESC
LIMIT 1
");

$data_gol = mysqli_fetch_assoc($riwayat_gol);

$riwayat_jabatan = mysqli_query($conn,"
SELECT * FROM riwayat_jabatan 
WHERE nip='$nip'
ORDER BY tmt DESC
LIMIT 1
");

$data_jabatan = mysqli_fetch_assoc($riwayat_jabatan);

$golongan = mysqli_query($conn,"SELECT * FROM master_golongan");
$jabatan  = mysqli_query($conn,"SELECT * FROM master_jabatan");
$jk       = mysqli_query($conn,"SELECT * FROM master_jenis_kelamin");
$agama    = mysqli_query($conn,"SELECT * FROM master_agama");
$status   = mysqli_query($conn,"SELECT * FROM master_status_perkawinan");
$unit     = mysqli_query($conn,"SELECT * FROM master_divisi");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data – Identitas</title>
<link rel="stylesheet" href="style.css" />
<style>
.sidebar-edit {
    width: 179px;
    background: linear-gradient(to bottom, #8b0000, #3b0000);
    color: #fff;
    padding: 20px 15px;
    min-height: 100vh;
}

.form-edit {
    max-width: 1000px;
    margin-top: 30px;
    flex: 1;
}
.baris-edit{
    display:grid;
    grid-template-columns: 260px 1fr;
    align-items:center;
    gap:15px;
    margin-bottom:16px;
}

.baris-edit label{
    font-weight:500;
}
.baris-edit input,
.baris-edit select,
.baris-edit textarea{
    width:100%;
    padding:8px 10px;
    border:1px solid #999;
    border-radius:4px;
}

.baris-edit textarea {
    min-height: 80px;
    resize: vertical;
}

.aksi-edit {
    margin-top: 20px;
    display: flex;
    gap: 15px;
    justify-content: flex-end; /* INI KUNCINYA */
}

/* Paksa menu jadi biru */
.sidebar-edit .item-menu {
    display: block;
    padding: 8px 5px;
    font-weight: bold;
    text-align: center;
    cursor: pointer;

    color: #fff !important;   /* pakai ini kalau masih ketimpa */
    text-decoration: none;
}
/* Wrapper foto + form */
.bagian-identitas {
    display: flex;
    align-items: flex-start;
    gap: 60px;
    margin-top: 60px; /* supaya turun dari judul */
}

/* Kotak foto */
.kotak-foto {
    width: 150px;
    margin-top: 30px;
}

.pratinjau-foto {
    width: 150px;
    height: 200px;   /* rasio 3:4 */
    background: #ccc;
    border: 2px solid #999;
}

/* Hilangkan efek visited */
.sidebar-edit .item-menu:visited {
    color: #fff !important;
    text-decoration: none;
}

/* Aktif pakai underline */
.sidebar-edit .item-menu.aktif {
    text-decoration: underline;
}
.input-gabung{
    display:flex;
    gap:10px;
}

.input-gabung input[type="text"]{
    flex:2;
}

.input-gabung input[type="date"]{
    flex:1;
}
</style>
</head>

<body class="role-user">
    <!-- SIDEBAR -->
<aside class="sidebar-edit">
    <div class="logo">
        <span>LOGO</span>
        <button class="tombol-menu" id="tombolMenu">✕</button>
    </div>
      <hr class="garis-menu" />

      <a href="Identitas_User.html" class="item-menu">Profil</a>

      <hr class="garis-menu" />

      <div class="item-menu aktif" id="menuEditData">
        Edit Data
        <span class="panah-menu" id="panahEditData">▼</span>
    </div>

    <div class="submenu" id="submenuEditData">
        <a href="Edit_Identitas_User.php" class="item-submenu aktif">Identitas</a>
        <a href="Edit_Riwayat_Golongan_User.php" class="item-submenu">Riwayat Golongan</a>
        <a href="Edit_Riwayat_Jabatan_User.php" class="item-submenu">Riwayat Jabatan</a>
        <a href="Edit_Riwayat_Pendidikan_User.html" class="item-submenu">Riwayat Pendidikan</a>
        <a href="Edit_Riwayat_Diklat_User.html" class="item-submenu">Riwayat Diklat</a>
        <a href="Edit_Riwayat_Keluarga_User.html" class="item-submenu">Riwayat Keluarga</a>
        <a href="Edit_Riwayat_Kehormatan_User.html" class="item-submenu">Riwayat Kehormatan</a>
        <a href="Edit_Riwayat_SKP_User.html" class="item-submenu">Riwayat SKP</a>
    </div>

    <hr class="garis-menu" />

    <a href="Pengaturan_Akun_User.html" class="item-menu">Pengaturan Akun</a>

      <hr class="garis-menu" />
    </aside>


<!-- KONTEN -->
<main class="konten">
    <h2>Identitas</h2>
     <!-- <button class="tombol-keluar">Log Out</button> -->
     <div class="user-profile" id="userProfile">
        <div class="user-info">
          <div class="user-icon">👤</div>
          <div class="user-text">
            <div class="user-name">TU SEKRETARIS KPU</div>
            <!-- <div class="user-role">Tata Usaha</div> -->
          </div>
        </div>

        <div class="dropdown-menu" id="dropdownMenu">
          <a href="#">Beranda</a>
          <a href="#">Keluar</a>
        </div>
      </div>

      <form method="POST" action="Simpan_Identitas.php" enctype="multipart/form-data">

        <div class="bagian-identitas">

        <!-- FOTO -->
        <div class="kotak-foto">
        <div class="pratinjau-foto"></div>
        <input type="file" name="foto" accept="image/jpeg">
        </div>

        <div class="form-edit">

        <div class="baris-edit">
        <label>Nama</label>
        <input type="text" name="nama_pegawai" value="<?= $data['nama_pegawai'] ?>">
        </div>

        <div class="baris-edit">
        <label>NIP</label>
        <input type="text" name="nip" value="<?= $data['nip'] ?>">
        </div>

        <!-- Golongan -->
        <div class="baris-edit">
        <label>Pangkat / Gol.Ruang / TMT</label>

        <div class="input-gabung">
        <select name="id_gol">

        <?php while($g = mysqli_fetch_assoc($golongan)){ ?>

        <option value="<?= $g['id_gol'] ?>"
        <?php if($data['id_gol']==$g['id_gol']) echo "selected"; ?>>

        <?= $g['nama_pangkat'] ?> / <?= $g['kode_gol'] ?>

        </option>

        <?php } ?>

        </select>

        <input type="date" name="tmt_golongan" value="<?= $data_gol['tmt'] ?>">

        </div>
        </div>


        <!-- Jabatan -->
        <div class="baris-edit">
        <label>Jabatan Terakhir / TMT</label>

        <div class="input-gabung">
        <select name="id_jabatan">

        <?php while($g = mysqli_fetch_assoc($jabatan)){ ?>

        <option value="<?= $g['id_jabatan'] ?>"
        <?php if($data['id_jabatan']==$g['id_jabatan']) echo "selected"; ?>>

        <?= $g['nama_jabatan'] ?> / <?= $g['jenis_jabatan'] ?>

        </option>

        <?php } ?>

        </select>

        <input type="date" name="tmt_jabatan" value="<?= $data_jabatan['tmt'] ?>">
        </div>
        </div>


        <div class="baris-edit">
        <label>TMT CPNS</label>
        <input type="date" name="tmt_cpns" value="<?= $data['tmt_cpns'] ?>">
        </div>

        <div class="baris-edit">
        <label>TMT PNS</label>
        <input type="date" name="tmt_pns" value="<?= $data['tmt_pns'] ?>">
        </div>


        <div class="baris-edit">
        <label>Tempat & Tanggal Lahir</label>

        <div class="input-gabung">
        <input type="text" name="tempat_lahir" value="<?= $data['tempat_lahir'] ?>">
        <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>">
        </div>

        </div>

        <div class="baris-edit">
        <label>Jenis Kelamin</label>

        <select name="id_jenis_kelamin">

        <?php while($k = mysqli_fetch_assoc($jk)){ ?>

        <option value="<?= $k['id_jenis_kelamin'] ?>"
        <?php if($data['id_jenis_kelamin']==$k['id_jenis_kelamin']) echo "selected"; ?>>

        <?= $k['jenis_kelamin'] ?>

        </option>

        <?php } ?>

        </select>
        </div>


        <div class="baris-edit">
        <label>Agama</label>

        <select name="id_agama">

        <?php while($a = mysqli_fetch_assoc($agama)){ ?>

        <option value="<?= $a['id_agama'] ?>">
        <?= $a['agama'] ?>
        </option>

        <?php } ?>

        </select>

        </div>


        <div class="baris-edit">
        <label>Status Perkawinan</label>

        <select name="id_status_perkawinan">

        <?php while($s = mysqli_fetch_assoc($status)){ ?>

        <option value="<?= $s['id_status_perkawinan'] ?>">
        <?= $s['status_perkawinan'] ?>
        </option>

        <?php } ?>

        </select>

        </div>


        <div class="baris-edit">
        <label>Unit Kerja</label>

        <select name="id_unit_kerja">

        <?php while($u = mysqli_fetch_assoc($unit)){ ?>

        <option value="<?= $u['id_unit_kerja'] ?>">
        <?= $u['unit_kerja'] ?>
        </option>

        <?php } ?>

        </select>

        </div>


        <div class="baris-edit">
        <label>No Telepon</label>
        <input type="text" name="no_telp" value="<?= $data['no_telp'] ?>">
        </div>


        <div class="baris-edit">
        <label>Alamat Rumah</label>
        <textarea name="alamat"><?= $data['alamat'] ?></textarea>
        </div>


        <div class="aksi-edit">
        <button type="submit" class="tombol-ubah">UBAH</button>
        <button type="reset" class="tombol-hapus">HAPUS</button>
        </div>

        </div>
        </div>

        </form>

<script src="script.js"></script>

</body>
</html>