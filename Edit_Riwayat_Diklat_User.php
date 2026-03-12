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

/* TAMBAH RIWAYAT DIKLAT */
if(isset($_POST['tambah'])){

    $id_jenis_diklat = $_POST['id_jenis_diklat'];
    $nama_diklat     = $_POST['nama_diklat'];
    $tahun           = $_POST['tahun'];

    if(!empty($id_jenis_diklat) && !empty($nama_diklat) && !empty($tahun)){

        $cek = mysqli_query($conn,"
        SELECT * FROM riwayat_diklat
        WHERE nip='$nip'
        AND id_jenis_diklat='$id_jenis_diklat'
        AND nama_diklat='$nama_diklat'
        AND tahun='$tahun'
        ");

        if(mysqli_num_rows($cek)==0){

            mysqli_query($conn,"
            INSERT INTO riwayat_diklat
            (
            nip,
            id_jenis_diklat,
            nama_diklat,
            tahun
            )
            VALUES
            (
            '$nip',
            '$id_jenis_diklat',
            '$nama_diklat',
            '$tahun'
            )
            ");

            header("Location: Edit_Riwayat_Diklat_User.php");
            exit;
        }
    }
}


/* UBAH RIWAYAT DIKLAT */
if(isset($_POST['ubah'])){

    $id              = $_POST['id_riwayat_diklat'];
    $id_jenis_diklat = $_POST['id_jenis_diklat'];
    $nama_diklat     = $_POST['nama_diklat'];
    $tahun           = $_POST['tahun'];

    if(!empty($id) && !empty($id_jenis_diklat) && !empty($nama_diklat) && !empty($tahun)){

        mysqli_query($conn,"
        UPDATE riwayat_diklat
        SET
        id_jenis_diklat='$id_jenis_diklat',
        nama_diklat='$nama_diklat',
        tahun='$tahun'
        WHERE id_riwayat_diklat='$id'
        ");

        header("Location: Edit_Riwayat_Diklat_User.php");
        exit;
    }
}

/* HAPUS */
if(isset($_POST['hapus'])){

    $id = $_POST['id_riwayat_diklat'];

    mysqli_query($conn,"
    DELETE FROM riwayat_diklat
    WHERE id_riwayat_diklat='$id'
    ");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data – Riwayat Diklat</title>
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
        <a href="Edit_Riwayat_Pendidikan_User.php" class="item-submenu">Riwayat Pendidikan</a>
        <a href="Edit_Riwayat_Diklat_User.php" class="item-submenu aktif">Riwayat Diklat</a>
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
    <h2>Riwayat Diklat</h2>
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
        <!-- FORM -->
            <div class="form-edit">
            <form method="POST">

            <input type="hidden" name="id_riwayat_diklat" id="id_riwayat_diklat">

            <!-- BARIS JENIS DIKLAT -->
            <div class="baris-form" style="grid-template-columns:120px 500px 120px;">
            <label>Jenis Diklat</label>

            <select name="id_jenis_diklat" style="height:30px; border:1px solid #888;">
            <option value="">Pilih Jenis Diklat</option>

            <?php
            $qDiklat = mysqli_query($conn,"SELECT * FROM master_diklat ORDER BY id_jenis_diklat");

            while($d = mysqli_fetch_assoc($qDiklat)){
            echo "<option value='$d[id_jenis_diklat]'>$d[jenis_diklat]</option>";
            }
            ?>

            </select>

            <button type="submit" name="tambah" class="tombol-tambah btn-kecil">
            TAMBAH
            </button>

            </div>


            <!-- BARIS NAMA DIKLAT -->
            <div class="baris-form" style="grid-template-columns:120px 500px 120px;">
            <label>Nama Diklat</label>

            <input type="text" name="nama_diklat" placeholder="Nama Diklat">

            <button type="submit" name="ubah" class="tombol-ubah btn-kecil">
            UBAH
            </button>

            </div>

            <!-- BARIS TAHUN -->
            <div class="baris-form" style="grid-template-columns:120px 500px 120px;">
                <label>Tahun</label>

                <input type="number" name="tahun" placeholder="YYYY">

                <div class="aksi-vertikal">
                    <button type="submit" name="hapus" class="tombol-hapus btn-kecil">
                        HAPUS
                    </button>
                </div>
            </div>


            <!-- TABEL -->
            <table class="tabel-riwayat" border="1" cellpadding="5">

            <thead>
            <tr>
            <th>Jenis Diklat</th>
            <th>Nama Diklat</th>
            <th>Tahun</th>
            </tr>
            </thead>

            <tbody>

            <?php
            $data = mysqli_query($conn,"
            SELECT rd.*, md.jenis_diklat
            FROM riwayat_diklat rd
            JOIN master_diklat md
            ON rd.id_jenis_diklat = md.id_jenis_diklat
            WHERE rd.nip='$nip'
            ORDER BY rd.tahun DESC
            ");

            while($row = mysqli_fetch_assoc($data)){

            echo "<tr onclick=\"pilihData('".$row['id_riwayat_diklat']."','".$row['id_jenis_diklat']."','".$row['nama_diklat']."','".$row['tahun']."')\">

            <td>".$row['jenis_diklat']."</td>
            <td>".$row['nama_diklat']."</td>
            <td>".$row['tahun']."</td>

            </tr>";

            }
            ?>

            </tbody>
            </table>
        </div>
        </form>
        </div>
    </div>

</main>
<script src="script.js"></script>
<script>
function pilihData(id,id_jenis,nama,tahun){

document.getElementById("id_riwayat_diklat").value = id;
document.querySelector("select[name='id_jenis_diklat']").value = id_jenis;
document.querySelector("input[name='nama_diklat']").value = nama;
document.querySelector("input[name='tahun']").value = tahun;

}
</script>

</body>
</html>