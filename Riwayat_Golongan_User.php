<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['nip'])){
    header("location:Login.php");
    exit;
}

$nip = $_SESSION['nip'];

$query = mysqli_query($conn,"
SELECT 
p.*,
jk.jenis_kelamin,
a.agama,
s.status_perkawinan,
u.unit_kerja
FROM pegawai p
LEFT JOIN master_jenis_kelamin jk ON p.id_jenis_kelamin = jk.id_jenis_kelamin
LEFT JOIN master_agama a ON p.id_agama = a.id_agama
LEFT JOIN master_status_perkawinan s ON p.id_status_perkawinan = s.id_status_perkawinan
LEFT JOIN master_divisi u ON p.id_unit_kerja = u.id_unit_kerja
WHERE p.nip='$nip'
");

$data = mysqli_fetch_assoc($query);

$riwayat_gol = mysqli_query($conn,"
SELECT g.nama_pangkat, g.kode_gol, r.tmt_golongan
FROM riwayat_golongan r
JOIN master_golongan g ON r.id_gol = g.id_gol
WHERE r.nip='$nip'
ORDER BY r.id_riwayat_gol DESC
LIMIT 1
");
$data_gol = mysqli_fetch_assoc($riwayat_gol);

$riwayat_jabatan = mysqli_query($conn,"
SELECT j.nama_jabatan, j.jenis_jabatan, r.tmt_jabatan
FROM riwayat_jabatan r
JOIN master_jabatan j ON r.id_jabatan = j.id_jabatan
WHERE r.nip='$nip'
ORDER BY r.id_riwayat_jabatan DESC
LIMIT 1
");

$data_jabatan = mysqli_fetch_assoc($riwayat_jabatan);

$riwayat_pendidikan = mysqli_query($conn,"
SELECT jp.jenjang_pend, r.institusi, r.tahun_lulus
FROM riwayat_pendidikan r
JOIN master_jenjang_pend jp ON r.id_jenjang_pend = jp.id_jenjang_pend
WHERE r.nip='$nip'
ORDER BY r.id_riwayat_pend DESC
LIMIT 1
");

$data_pendidikan = mysqli_fetch_assoc($riwayat_pendidikan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data – Riwayat Golongan</title>
    <link rel="stylesheet" href="style.css">
    <style>

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

                <div class="dropdown-menu">
                  <a href="#">Beranda</a>
                  <a href="#">Keluar</a>
                </div>
              </div>

          </div>

          <div class="header-profil">
          <div class="profil-atas">
                    
            <!-- FOTO -->
              <div class="kotak-foto-profil"></div>
          
            <!-- INFO -->
            <div class="info-profil">
               <h2><?= $data['nama_pegawai'] ?></h2>
               <p>
                <?= $data['nama_pegawai'] ?> adalah 
                <?= $data_jabatan['nama_jabatan'] ?? '-' ?> di 
                <?= $data['unit_kerja'] ?>.

                Memiliki riwayat jabatan sejak 
                <?= isset($data_jabatan['tmt_jabatan']) ? date('Y', strtotime($data_jabatan['tmt_jabatan'])) : '-' ?> 
                dengan pangkat/golongan terakhir 
                <?= $data_gol['nama_pangkat'] ?? '-' ?> (<?= $data_gol['kode_gol'] ?? '-' ?>).

                Pendidikan terakhir 
                <?= $data_pendidikan['jenjang_pend'] ?? '-' ?> dari 
                <?= $data_pendidikan['institusi'] ?? '-' ?> (<?= $data_pendidikan['tahun_lulus'] ?? '-' ?>).
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
    <a href="Identitas_User.php" class="tab">Identitas</a>
    <a href="Riwayat_Golongan_User.php" class="tab aktif">Riwayat Golongan</a>
    <a href="Riwayat_Jabatan_User.php" class="tab">Riwayat Jabatan</a>
    <a href="Riwayat_Pendidikan_User.php" class="tab">Riwayat Pendidikan</a>
    <a href="Riwayat_Diklat_User.php" class="tab">Riwayat Diklat</a>
    <a href="Riwayat_Keluarga_User.php" class="tab">Riwayat Keluarga</a>
    <a href="Riwayat_Kehormatan_User.php" class="tab">Riwayat Kehormatan</a>
    <a href="Riwayat_SKP_User.php" class="tab">Riwayat SKP</a>
  </div>

    <div class="pembungkus-form">
        <div class="form">
            <!-- TABEL -->
            <table class="tabel-riwayat" border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>Golongan Pangkat</th>
                    <th>TMT</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $stmt = $conn->prepare("
                SELECT rg.*, mg.kode_gol, mg.nama_pangkat
                FROM riwayat_golongan rg
                JOIN master_golongan mg ON rg.id_gol = mg.id_gol
                WHERE rg.nip=?
                ORDER BY rg.tmt_golongan DESC
            ");
            $stmt->bind_param("s", $nip);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while($row = $result->fetch_assoc()){
                echo "<tr>
                    <td>".$row['kode_gol']." - ".$row['nama_pangkat']."</td>
                    <td>".date('d-m-Y', strtotime($row['tmt_golongan']))."</td>
                </tr>";
            }
            ?>
            </tbody>
          </table>
        </div>
    </div>
</main>

<script src="script.js"></script>
</body>
</html>
