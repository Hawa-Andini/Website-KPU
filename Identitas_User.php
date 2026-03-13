<?php
session_start();   
include "koneksi.php";

if(!isset($_SESSION['nip'])){
    header("location:Login.php");
    exit;
}

$username = $_SESSION['username'] ?? '';
$nip = $_SESSION['nip'];

$query = mysqli_query($conn,"SELECT * FROM pegawai WHERE nip='$nip'");
$data = mysqli_fetch_assoc($query);

$riwayat_gol = mysqli_query($conn,"
SELECT *
FROM riwayat_golongan
WHERE nip='$nip'
ORDER BY id_riwayat_gol DESC
LIMIT 1
");

$data_gol = mysqli_fetch_assoc($riwayat_gol) ?? [];

$riwayat_jabatan = mysqli_query($conn,"
SELECT *
FROM riwayat_jabatan
WHERE nip='$nip'
ORDER BY id_riwayat_jabatan DESC
LIMIT 1
");

$data_jabatan = mysqli_fetch_assoc($riwayat_jabatan) ?? [];

$golongan = mysqli_query($conn,"SELECT * FROM master_golongan");
$jabatan  = mysqli_query($conn,"SELECT * FROM master_jabatan");
$jk       = mysqli_query($conn,"SELECT * FROM master_jenis_kelamin");
$agama    = mysqli_query($conn,"SELECT * FROM master_agama");
$status   = mysqli_query($conn,"SELECT * FROM master_status_perkawinan");
$unit     = mysqli_query($conn,"SELECT * FROM master_divisi");
$kabupaten = mysqli_query($conn,"SELECT * FROM master_kabupaten ORDER BY nama_kabupaten ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data – Riwayat Golongan</title>
    <link rel="stylesheet" href="style.css">
    <style>
              /* HEADER PROFIL */
.header-profil {
  position: relative;
  margin-bottom: 30px;
}

.profil-atas {
  display: flex;
  align-items: center;
  gap: 30px;
  margin-top: 40px;
}

/* FOTO */
.kotak-foto-profil {
  width: 160px;
  height: 200px;
  border: 2px solid #999;
  background: #e0e0e0;
}

/* INFO */
.info-profil {
  flex: 1;
}

.info-profil h2 {
  margin: 0 0 10px;
  font-size: 26px;
}

.info-profil p {
  font-size: 16px;
  line-height: 1.6;
}

/* AREA PDF */
.pdf-box {
  width: 120px;
  height: 140px;
  border: 2px solid #999;
  border-radius: 12px;
  text-decoration: none;
  background: #f0f0f0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.pdf-icon {
  width: 60px;
  height: 70px;
  background: #d32f2f;
  color: white;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  margin-bottom: 10px;
}
        .tab-menu { 
    display: flex; 
    width: calc(100% + 80px);  /* tambahkan 40 kiri + 40 kanan */
    margin: 50px -40px 20px -40px; 
    padding: 0; 
    border-bottom:1px solid #000; 
    border-top: 1px solid #000; 
    background-color: #fff; 
    overflow-x: auto; 
}

    /* .tab { padding: 15px 20px; border: none; background: #fff; border-right: 1px solid #000; cursor: pointer; } */ 
      .tab-menu .tab { 
        flex: 1; /* SEMUA TAB LEBARNYA SAMA */ 
        padding: 20px 10px; 
        border: none; 
        border-right: 1px solid #000; 
        background: #fff; 
        cursor: pointer; 
        font-weight: 600; 
        white-space: nowrap; 
    } 
      .tab-menu .tab:last-child { 
        border-right: none; } /* .tab.aktif { background: #7b0000; color: white; } */ 
      .tab-menu .tab.aktif { 
        background-color: #7b0000; 
        color: #fff; 
        border-bottom: 2px solid #7b0000; 
    }


     /* NEW PROFIL */
      /* USER PROFILE */
      .user-profile {
        top: 20px;
        right: 40px;
        cursor: pointer;
        position: absolute;
        display: inline-block;
        z-index: 10000;
      }

      .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f2f2f2;
        padding: 10px 15px;
        border-radius: 15px;
      }

      .user-icon {
        font-size: 24px;
      }

      .user-name {
        font-weight: bold;
        font-size: 14px;
      }

      
      /* DROPDOWN */
      .dropdown-menu {
        display: none;
        position: absolute;  
        top: 60px;
        right: 0;
        background: #f2f2f2;
        border-radius: 15px;
        padding: 15px 20px;
        width: 200px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
      }

      .dropdown-menu a {
        display: block;
        text-decoration: none;
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 15px;
      }

      .dropdown-menu a:last-child {
        margin-bottom: 0;
      }

      /* TAMPIL SAAT AKTIF */
      .user-profile.active .dropdown-menu {
        display: block;
      }
      .header-atas {
          display: flex;
          justify-content: space-between;
          align-items: center;
      }
      
    </style>
</head>
<body class="role-user">

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    
    <div class="logo">
      <span>LOGO</span>
      <button class="tombol-menu" id="tombolMenu">✕</button>
  </div>
    <hr class="garis-menu" />

    <div class="item-menu aktif">Profil</div>

    <hr class="garis-menu" />

    <div class="item-menu" id="menuEditData">
      Edit Data
    <span class="panah-menu" id="panahEditData">▼</span>
  </div>

  <div class="submenu" id="submenuEditData">
      <a href="Edit_Identitas_User.php" class="item-submenu">Identitas</a>
      <a href="Edit_Riwayat_Golongan_User.php" class="item-submenu">Riwayat Golongan</a>
      <a href="Edit_Riwayat_Jabatan_User.php" class="item-submenu">Riwayat Jabatan</a>
      <a href="Edit_Riwayat_Pendidikan_User.php" class="item-submenu">Riwayat Pendidikan</a>
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

          <div class="header-atas">

              <h2 class="judul-halaman">Profil</h2>

              <div class="user-profile" id="userProfile">
                <div class="user-info">
                  <div class="user-icon">👤</div>
                  <div class="user-name">
                  <?= $data['nama_pegawai'] ?>
                  </div>
                </div>

                <div class="dropdown-menu" id="dropdownMenu">
                  <a href="Logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                  Keluar
                  </a>
                </div>
              </div>

          </div>

          <div class="header-profil">
          <div class="profil-atas">
                    
            <!-- FOTO -->
              <div class="kotak-foto-profil"></div>
          
            <!-- INFO -->
              <div class="info-profil">
               <h2>Hawa Andini Hadi</h2>
                <p>
                  [Nama] adalah [status/jabatan saat ini] di [unit kerja/instansi].
                  Memiliki riwayat jabatan sejak [tahun mulai] dengan pangkat/
                  golongan terakhir [golongan terakhir].
                  Pendidikan terakhir [jenjang] dari [institusi].
                </p>
                </div>
          
             <!-- PDF -->
              <a href="file-cv.pdf" download class="pdf-box">
                <div class="pdf-icon">PDF</div>
                  <span>Lihat PDF</span>
              </a>
          </div>
        </div>

        <div class="tab-menu">
    <a href="Identitas_User.php" class="tab aktif">Identitas</a>
    <a href="Riwayat_Golongan_User.php" class="tab">Riwayat Golongan</a>
    <a href="Riwayat_Jabatan_User.php" class="tab">Riwayat Jabatan</a>
    <a href="Riwayat_Pendidikan_User.php" class="tab">Riwayat Pendidikan</a>
    <a href="Riwayat_Diklat_User.php" class="tab">Riwayat Diklat</a>
    <a href="Riwayat_Keluarga_User.php" class="tab">Riwayat Keluarga</a>
    <a href="Riwayat_Kehormatan_User.php" class="tab">Riwayat Kehormatan</a>
    <a href="Riwayat_SKP_User.php" class="tab">Riwayat SKP</a>
  </div>

  <section class="form-identitas">
    <div class="form">
    <div class="baris-form">
    <label>Nama</label>
    <input type="text" value="<?= htmlspecialchars($data['nama_pegawai'] ?? '') ?>" readonly>
    </div>

    <div class="baris-form">
    <label>NIP</label>
    <input type="text" value="<?= htmlspecialchars($data['nip'] ?? '') ?>" readonly>
    </div>

    <div class="baris-form">
    <label>Pangkat/Gol. Ruang/TMT</label>
    <input type="text" value="<?= htmlspecialchars($data['id_gol'] ?? '') ?>" readonly>
    </div>

    <div class="baris-form">
    <label>Jabatan Terakhir / TMT</label>
    <input type="text" value="" readonly>
    </div>

    <div class="baris-form">
    <label>TMT CPNS</label>
    <input type="date" value="<?= $data['tmt_cpns'] ?? '' ?>" readonly>
    </div>

    <div class="baris-form">
    <label>TMT PNS</label>
    <input type="date" value="<?= $data['tmt_pns'] ?? '' ?>" readonly>
    </div>

    <div class="baris-form">
    <label>Tempat & Tanggal Lahir</label>
    <input type="text" 
    value="<?= htmlspecialchars(($data['tempat_lahir'] ?? '') . ', ' . ($data['tanggal_lahir'] ?? '')) ?>" 
    readonly>
    </div>

    <div class="baris-form">
    <label>Jenis Kelamin</label>
    <input type="text" value="<?= htmlspecialchars($data['id_jenis_kelamin'] ?? '') ?>" readonly>
    </div>

    <div class="baris-form">
    <label>Agama</label>
    <input type="text" value="<?= htmlspecialchars($data['id_agama'] ?? '') ?>" readonly>
    </div>

    <div class="baris-form">
    <label>Status Perkawinan</label>
    <input type="text" value="<?= htmlspecialchars($data['id_status_perkawinan'] ?? '') ?>" readonly>
    </div>

    <div class="baris-form">
    <label>Unit Kerja</label>
    <input type="text" value="<?= htmlspecialchars($data['id_unit_kerja'] ?? '') ?>" readonly>
    </div>

    <div class="baris-form">
    <label>No Telepon</label>
    <input type="text" value="<?= htmlspecialchars($data['no_telp'] ?? '') ?>" readonly>
    </div>

    <div class="baris-form">
    <label>Alamat Rumah</label>
    <textarea readonly><?= htmlspecialchars($data['alamat'] ?? '') ?></textarea>
    </div>

    </div>
</section>
</main>

<script src="script.js"></script>
</body>
</html>
