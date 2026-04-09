<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['nip'])){
    header("location: ../auth/Login.php");
    exit;
}

$nip = $_POST['nip'] ?? $_GET['nip'] ?? '';

if(empty($nip)){
    die("NIP tidak ditemukan");
}

$query = mysqli_query($conn,"SELECT * FROM pegawai WHERE nip='$nip'");
$pegawai = mysqli_fetch_assoc($query);

if(!$pegawai){
    die("Data pegawai tidak ditemukan");
}


/* =========================
   TAMBAH RIWAYAT GOLONGAN
   ========================= */
if(isset($_POST['tambah'])){

    $id_gol = $_POST['id_gol'];
    $tmt_golongan = $_POST['tmt_golongan'];

    if(!empty($id_gol) && !empty($tmt_golongan)){

        $cek = mysqli_query($conn,"
        SELECT * FROM riwayat_golongan 
        WHERE nip='$nip'
        AND id_gol='$id_gol'
        AND tmt_golongan='$tmt_golongan'
        ");

        if(mysqli_num_rows($cek)==0){

            mysqli_query($conn,"
            INSERT INTO riwayat_golongan
            (nip, id_gol, tmt_golongan)
            VALUES
            ('$nip','$id_gol','$tmt_golongan')
            ");

            header("Location: Admin_Edit_Riwayat_Golongan.php?nip=$nip");
            exit;

        }else{
            echo "<script>alert('Data sudah ada');</script>";
        }

    }else{
        echo "<script>alert('Lengkapi data terlebih dahulu');</script>";
    }
}


/* =========================
   UBAH RIWAYAT GOLONGAN
   ========================= */
if(isset($_POST['ubah'])){

    $id = $_POST['id_riwayat_gol'];
    $id_gol = $_POST['id_gol'];
    $tmt_golongan = $_POST['tmt_golongan'];

    if(empty($id)){
        die("Pilih data dulu dari tabel");
    }

    if(!empty($id_gol) && !empty($tmt_golongan)){

        mysqli_query($conn,"
        UPDATE riwayat_golongan
        SET id_gol='$id_gol',
            tmt_golongan='$tmt_golongan'
        WHERE id_riwayat_gol='$id'
        ");

        header("Location: Admin_Edit_Riwayat_Golongan.php?nip=$nip");
        exit;

    }else{
        echo "<script>alert('Lengkapi data terlebih dahulu');</script>";
    }
}


/* =========================
   HAPUS RIWAYAT GOLONGAN
   ========================= */
if(isset($_POST['hapus'])){

    $id = $_POST['id_riwayat_gol'];

    if(empty($id)){
        die("Pilih data dulu");
    }

    mysqli_query($conn,"
    DELETE FROM riwayat_golongan
    WHERE id_riwayat_gol='$id'
    ");

    header("Location: Admin_Edit_Riwayat_Golongan.php?nip=$nip");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data – Riwayat Golongan</title>
<link rel="stylesheet" href="../assets/style.css" />
<link rel="stylesheet" href="../assets/edit_riwayat.css" />

</head>

<body class="role-admin">

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
      <div class="logo">
        <span>LOGO</span>
        <button class="tombol-menu" id="tombolMenu">✕</button>
      </div>

      <hr class="garis-menu" />

      <a href="Admin_Profil_Data_Pegawai.php" class="item-menu aktif">
        Profil Data Pegawai
      </a>

      <hr class="garis-menu" />

      <a href="Admin_Tambah_Data.php" class="item-menu">
        Tambah Data Pegawai Baru
      </a>

      <hr class="garis-menu" />

      <a href="Admin_Pengaturan_Akun.php" class="item-menu">
        Pengaturan Akun
      </a>

      <hr class="garis-menu" />

      <div class="item-menu" id="menuDataMaster">
        Data Master
        <span class="panah-menu" id="panahDataMaster">▼</span>
      </div>

      <div class="submenu" id="submenuDataMaster">
        <a href="Admin_DM_Gender.php" class="item-submenu">Jenis Kelamin</a>
        <a href="Admin_DM_Agama.php" class="item-submenu">Agama</a>
        <a href="Admin_DM_StatusPerkawinan.php" class="item-submenu"
          >Status Perkawinan</a
        >
        <a href="Admin_DM_JenjangPendidikan.php" class="item-submenu"
          >Jenjang Pendidikan</a
        >
        <a href="Admin_DM_HubunganKeluarga.php" class="item-submenu"
          >Hubungan Keluarga</a
        >
        <a href="Admin_DM_Golongan.php" class="item-submenu">Golongan</a>
        <a href="Admin_DM_Jabatan.php" class="item-submenu">Jabatan</a>
        <a href="Admin_DM_UnitKerja.php" class="item-submenu"
          >Unit Kerja / Divisi</a
        >
        <a href="Admin_DM_JenisDiklat.php" class="item-submenu"
          >Jenis Diklat</a
        >
        <a href="Admin_DM_PredikatSKP.php" class="item-submenu"
          >Predikat SKP</a
        >
      </div>

      <hr class="garis-menu" />
      <a href="Admin_Manajemen_Akun.php" class="item-menu">
        Manajemen Akun
    </a>

    <hr class="garis-menu">
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
      <div class="tab-menu">
    <a href="identitas-pegawai.php?nip=<?= $nip ?>" class="tab">Identitas</a>    <a href="Admin_Edit_Riwayat_Golongan.php?nip=<?= $nip ?>" class="tab aktif">Riwayat Golongan</a>
    <a href="Admin_Edit_Riwayat_Jabatan.php?nip=<?= $nip ?>" class="tab">Riwayat Jabatan</a>
    <a href="Admin_Edit_Riwayat_Pendidikan.php?nip=<?= $nip ?>" class="tab">Riwayat Pendidikan</a>
    <a href="Admin_Edit_Riwayat_Diklat.php?nip=<?= $nip ?>" class="tab">Riwayat Diklat</a>
    <a href="Admin_Edit_Riwayat_Keluarga.php?nip=<?= $nip ?>" class="tab">Riwayat Keluarga</a>
    <a href="Admin_Edit_Riwayat_Kehormatan.php?nip=<?= $nip ?>" class="tab">Riwayat Kehormatan</a>
    <a href="Admin_Edit_Riwayat_SKP.php?nip=<?= $nip?>" class="tab">Riwayat SKP</a>
</div>
      <div class="bagian-identitas">
      <div class="form-edit">
        <form method="POST">
<input type="hidden" name="nip" value="<?= $nip ?>">
<input type="hidden" name="id_riwayat_gol" id="id_riwayat_gol">

<!-- TAMBAH -->
<div class="baris-form" style="grid-template-columns:120px 500px 120px">
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

<!-- UBAH -->
<div class="baris-form" style="grid-template-columns:120px 500px 120px">
    <label>TMT</label>

    <input type="date" name="tmt_golongan">

    <button type="submit" name="ubah" class="tombol-ubah btn-kecil">
        UBAH
    </button>
</div>

<!-- HAPUS -->
<div class="baris-form" style="grid-template-columns:120px 500px 120px">
    <label></label>
    <div></div>

    <button type="submit" name="hapus" class="tombol-hapus btn-kecil">
        HAPUS
    </button>
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
          $dataRiwayat = mysqli_query($conn,"
          SELECT rg.*, mg.kode_gol, mg.nama_pangkat
          FROM riwayat_golongan rg
          JOIN master_golongan mg ON rg.id_gol = mg.id_gol
          WHERE rg.nip='$nip'
          ORDER BY rg.tmt_golongan DESC
          ");

          while($row = mysqli_fetch_assoc($dataRiwayat)){

            echo "<tr onclick=\"pilihData('".$row['id_riwayat_gol']."','".$row['id_gol']."','".$row['tmt_golongan']."')\">
            <td>".$row['kode_gol']." - ".$row['nama_pangkat']."</td>
            <td>".date('d-m-Y', strtotime($row['tmt_golongan']))."</td>
            </tr>";
            
            }

        ?>
        </tbody>
        </table>

        </div>

</main>
<script src="../assets/script.js"></script>

<script>
  const userProfile = document.getElementById("userProfile");

      if (userProfile) {
        userProfile.addEventListener("click", function () {
          userProfile.classList.toggle("active");
        });

        // Tutup jika klik luar
        document.addEventListener("click", function (e) {
          if (!userProfile.contains(e.target)) {
            userProfile.classList.remove("active");
          }
        });
      }

function pilihData(id,id_gol,tmt_golongan){

document.getElementById("id_riwayat_gol").value = id;
document.querySelector("select[name='id_gol']").value = id_gol;
document.querySelector("input[name='tmt_golongan']").value = tmt_golongan;

}
</script>

<script src="../assets/core-ui.js"></script>
    <script src="../assets/datamaster.js"></script>
    <script src="../assets/admin-ui.js"></script>

</body>
</html>