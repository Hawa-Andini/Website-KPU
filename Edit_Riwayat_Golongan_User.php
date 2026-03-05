<?php
include("koneksi.php");
session_start();
$nip = $_SESSION['nip'];

$nip = $_GET['nip'] ?? '';

if(isset($_POST['tambah'])){

    $id_gol = $_POST['id_gol'];
    $tmt    = $_POST['tmt'];

    $query = mysqli_query($conn,"INSERT INTO riwayat_golongan(nip,id_gol,tmt)
    VALUES('$nip','$id_gol','$tmt')");

    if(!$query){
        echo "ERROR : ".mysqli_error($conn);
    } else {
        echo "DATA BERHASIL DISIMPAN";
    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data – Riwayat Golongan</title>
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
    max-width: 800px;
    margin-top: 30px;
    flex: 1;
}

/* Sidebar default putih */
.sidebar-edit {
    color: white;
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

/* Hilangkan efek visited */
.sidebar-edit .item-menu:visited {
    color: #fff !important;
    text-decoration: none;
}

/* Aktif pakai underline */
.sidebar-edit .item-menu.aktif {
    text-decoration: underline;
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
        <a href="Edit_Identitas_User.html" class="item-submenu">Identitas</a>
        <a href="Edit_Riwayat_Golongan_User.html" class="item-submenu aktif">Riwayat Golongan</a>
        <a href="Edit_Riwayat_Jabatan_User.html" class="item-submenu">Riwayat Jabatan</a>
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
    <h2>Riwayat Golongan</h2>
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
      <div class="bagian-identitas">
      <div class="form-edit">
        <form method="POST">

        <div class="baris-form" style="grid-template-columns:240px 1fr 80px;">
        <label>Golongan Pangkat</label>

        <select name="id_gol" style="height:30px; border:1px solid #888;">

        <option value="">Pilih Golongan</option>

        <?php

        $qGol = mysqli_query($conn,"SELECT * FROM master_golongan ORDER BY kode_gol");

        while($g = mysqli_fetch_assoc($qGol)){

        echo "<option value='$g[id_gol]'>$g[kode_gol] - $g[nama_pangkat]</option>";

        }

        ?>

        </select>

        <button type="submit" name="tambah" class="tombol-tambah btn-kecil">
        TAMBAH
        </button>

        </div>


        <div class="baris-form" style="grid-template-columns:240px 1fr 80px;">

        <label>TMT</label>

        <input type="date" name="tmt">

        <div class="aksi-vertikal">
        <button type="button" class="tombol-ubah btn-kecil">UBAH</button>
        <button type="button" class="tombol-hapus btn-kecil">HAPUS</button>
        </div>

        </div>

        </form>


        <table class="tabel-riwayat" border="1" cellpadding="5">

        <thead>
        <tr>
        <th>Golongan Pangkat</th>
        <th>TMT</th>
        </tr>
        </thead>

        <tbody>

        <?php

        $data = mysqli_query($conn,"
        SELECT rg.*, mg.kode_gol, mg.nama_pangkat
        FROM riwayat_golongan rg
        JOIN master_golongan mg ON rg.id_gol = mg.id_gol
        WHERE rg.nip='$nip'
        ORDER BY rg.tmt DESC
        ");

        while($row = mysqli_fetch_assoc($data)){

        echo "<tr>
        <td>$row[kode_gol] - $row[nama_pangkat]</td>
        <td>$row[tmt]</td>
        </tr>";

        }

        ?>

        </tbody>
        </table>

        </div>

</main>
<script src="script.js"></script>

</body>
</html>