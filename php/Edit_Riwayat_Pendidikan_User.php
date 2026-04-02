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

/* TAMBAH RIWAYAT PENDIDIKAN */
if(isset($_POST['tambah'])){

    $id_jenjang_pend = $_POST['id_jenjang_pend'];
    $institusi       = $_POST['institusi'];
    $tahun_lulus     = $_POST['tahun_lulus'];

    if(!empty($id_jenjang_pend) && !empty($institusi) && !empty($tahun_lulus)){

        $cek = mysqli_query($conn,"
        SELECT * FROM riwayat_pendidikan
        WHERE nip='$nip'
        AND id_jenjang_pend='$id_jenjang_pend'
        AND institusi='$institusi'
        AND tahun_lulus='$tahun_lulus'
        ");

        if(mysqli_num_rows($cek)==0){

            mysqli_query($conn,"
            INSERT INTO riwayat_pendidikan
            (
            nip,
            id_jenjang_pend,
            institusi,
            tahun_lulus
            )
            VALUES
            (
            '$nip',
            '$id_jenjang_pend',
            '$institusi',
            '$tahun_lulus'
            )
            ");

            header("Location: Edit_Riwayat_Pendidikan_User.php");
            exit;
        }
    }
}

/* UBAH RIWAYAT PENDIDIKAN */
if(isset($_POST['ubah'])){

    $id              = $_POST['id_riwayat_pend'];
    $id_jenjang_pend = $_POST['id_jenjang_pend'];
    $institusi       = $_POST['institusi'];
    $tahun_lulus     = $_POST['tahun_lulus'];

    if(!empty($id) && !empty($id_jenjang_pend) && !empty($institusi) && !empty($tahun_lulus)){

        mysqli_query($conn,"
        UPDATE riwayat_pendidikan
        SET
        id_jenjang_pend='$id_jenjang_pend',
        institusi='$institusi',
        tahun_lulus='$tahun_lulus'
        WHERE id_riwayat_pend='$id'
        ");

        header("Location: Edit_Riwayat_Pendidikan_User.php");
        exit;
    }
}

/* HAPUS */
if(isset($_POST['hapus'])){

    $id = $_POST['id_riwayat_pend'];

    mysqli_query($conn,"
    DELETE FROM riwayat_pendidikan
    WHERE id_riwayat_pend='$id'
    ");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data – Riwayat Pendidikan</title>
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
.tabel-riwayat tr{
cursor:pointer;
}

.tabel-riwayat tr:hover{
background:#f1f1f1;
}

.tabel-riwayat{
width:750px;
margin-top:30px;
}

.bagian-identitas{
display:flex;
justify-content:center;
margin-top: 20px;
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

      <a href="Identitas_User.php" class="item-menu">Profil</a>

      <hr class="garis-menu" />

      <div class="item-menu aktif" id="menuEditData">
        Edit Data
        <span class="panah-menu" id="panahEditData">▼</span>
    </div>

    <div class="submenu" id="submenuEditData">
        <a href="Edit_Identitas_User.php" class="item-submenu">Identitas</a>
        <a href="Edit_Riwayat_Golongan_User.php" class="item-submenu">Riwayat Golongan</a>
        <a href="Edit_Riwayat_Jabatan_User.php" class="item-submenu">Riwayat Jabatan</a>
        <a href="Edit_Riwayat_Pendidikan_User.php" class="item-submenu aktif">Riwayat Pendidikan</a>
        <a href="Edit_Riwayat_Diklat_User.php" class="item-submenu">Riwayat Diklat</a>
        <a href="Edit_Riwayat_Keluarga_User.php" class="item-submenu">Riwayat Keluarga</a>
        <a href="Edit_Riwayat_Kehormatan_User.php" class="item-submenu">Riwayat Kehormatan</a>
        <a href="Edit_Riwayat_SKP_User.php" class="item-submenu">Riwayat SKP</a>
    </div>

    <hr class="garis-menu" />

    <a href="Pengaturan_Akun_User.php" class="item-menu">Pengaturan Akun</a>

      <hr class="garis-menu" />
    </aside>


<!-- KONTEN -->
<main class="konten">
    <h2>Riwayat Pendidikan</h2>
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
            <a href="Identitas_User.php">Beranda</a>
            <a href="#" onclick="openLogoutModal()">Keluar</a>
        </div>
      </div>
      <div class="bagian-identitas">
        <!-- FORM -->
        <div class="form-edit">
        <form method="POST">
        <input type="hidden" name="id_riwayat_pend" id="id_riwayat_pend">

        <!-- BARIS JENJANG -->
        <div class="baris-form" style="grid-template-columns:120px 500px 120px;">
            <label>Jenjang Pendidikan</label>

            <select name="id_jenjang_pend" style="height:30px; border:1px solid #888;">
                <option value="">Pilih Jenjang</option>

                <?php
                $qPend = mysqli_query($conn,"SELECT * FROM master_jenjang_pend ORDER BY id_jenjang_pend");

                while($p = mysqli_fetch_assoc($qPend)){
                echo "<option value='$p[id_jenjang_pend]'>$p[jenjang_pend]</option>";
                }
                ?>
            </select>

            <button type="submit" name="tambah" class="tombol-tambah btn-kecil">
                TAMBAH
            </button>
        </div>


        <!-- BARIS INSTITUSI -->
        <div class="baris-form" style="grid-template-columns:120px 500px 120px;">
            <label>Institusi</label>

            <input type="text" name="institusi" placeholder="Nama Sekolah / Universitas">

            <button type="submit" name="ubah" class="tombol-ubah btn-kecil">
                UBAH
            </button>
        </div>


        <!-- BARIS TAHUN LULUS -->
        <div class="baris-form" style="grid-template-columns:120px 500px 120px;">
            <label>Tahun Lulus</label>

            <input type="number" name="tahun_lulus" placeholder="YYYY">

            <button type="submit" name="hapus" class="tombol-hapus btn-kecil">
                HAPUS
            </button>
        </div>
    
           <!-- TABEL -->
          <table class="tabel-riwayat" border="1" cellpadding="5">

          <thead>
          <tr>
          <th>Jenjang Pendidikan</th>
          <th>Institusi</th>
          <th>Tahun Lulus</th>
          </tr>
          </thead>

          <tbody>

          <?php
          $data = mysqli_query($conn,"
          SELECT rp.*, mj.jenjang_pend
          FROM riwayat_pendidikan rp
          JOIN master_jenjang_pend mj
          ON rp.id_jenjang_pend = mj.id_jenjang_pend
          WHERE rp.nip='$nip'
          ORDER BY rp.tahun_lulus DESC
          ");

          while($row = mysqli_fetch_assoc($data)){

          echo "<tr onclick=\"pilihData('".$row['id_riwayat_pend']."','".$row['id_jenjang_pend']."','".$row['institusi']."','".$row['tahun_lulus']."')\">

          <td>".$row['jenjang_pend']."</td>
          <td>".$row['institusi']."</td>
          <td>".$row['tahun_lulus']."</td>

          </tr>";

          }
          ?>

          </tbody>
          </table>
</main>
<div id="modalLogout" class="modal">
    <div class="modal-content">

        <h3>Konfirmasi Keluar</h3>
        <p>Apakah Anda yakin ingin keluar?</p>

         <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
            <button onclick="closeLogoutModal()" class="tombol-batal">
                Batal
            </button>

            <a href="Logout.php" class="tombol-keluar">
                Keluar
            </a>
        </div>
    </div>
</div>
<script src="script.js"></script>
<script>
function pilihData(id,id_jenjang,institusi,tahun){

document.getElementById("id_riwayat_pend").value = id;
document.querySelector("select[name='id_jenjang_pend']").value = id_jenjang;
document.querySelector("input[name='institusi']").value = institusi;
document.querySelector("input[name='tahun_lulus']").value = tahun;

}
</script>

</body>
</html>