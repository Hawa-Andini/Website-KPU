<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['nip'])){
    header("location: ../auth/Login.php");
    exit;
}

/* =========================
   QUERY DATA USER + PEGAWAI
========================= */
$query = mysqli_query($conn, "
    SELECT u.*, p.nama_pegawai AS nama
    FROM user u
    LEFT JOIN pegawai p ON u.nip = p.nip
");

/* =========================
   PROSES TAMBAH USER
========================= */
if(isset($_POST['tambah'])){
    $nip = $_POST['nip'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // validasi username unik
    $cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Username sudah digunakan');</script>";
    } else {
        mysqli_query($conn, "
            INSERT INTO user (nip, username, email, password, role, is_active)
            VALUES ('$nip','$username','$email','$password','$role',1)
        ");

        echo "<script>alert('User berhasil ditambahkan'); location.reload();</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Akun</title>
<link rel="stylesheet" href="../assets/style.css">
<link rel="stylesheet" href="../assets/datamaster.css" />
<link rel="stylesheet" href="../assets/manajemen_akun.css" />


</head>

<body class="role-admin">



<aside class="sidebar" id="sidebar">
      <div class="logo">
        <span>LOGO</span>
        <button class="tombol-menu" id="tombolMenu">✕</button>
      </div>

      <hr class="garis-menu" />

      <a href="Admin_Profil_Data_Pegawai.php" class="item-menu">
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

      <div class="submenu aktif" id="submenuDataMaster">
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
        <a href="Admin_DM_KabupatenKota.php" class="item-submenu">Kabupaten/Kota</a>
      </div>

      <hr class="garis-menu" />
      <a href="Admin_Manajemen_Akun.php" class="item-menu aktif">
        Manajemen Akun
    </a>

    <hr class="garis-menu">
    </aside>

<!-- KONTEN -->
<main class="konten">
    <div class="user-profile" id="userProfile">
        <div class="user-info">
          <div class="user-icon">👤</div>
          <div class="user-text">
            <div class="user-name">TU SEKRETARIS KPU</div>
            <!-- <div class="user-role">Tata Usaha</div> -->
          </div>
        </div>

        <div class="dropdown-menu" id="dropdownMenu">
          <a href="Admin_Profil_Data_Pegawai.php">Beranda</a>
          <a href="#">Keluar</a>
        </div>
      </div>

<h2>Manajemen Akun</h2>

<div class="table-top">
    <div>
        Show
        <select>
            <option>10</option>
            <option>25</option>
        </select>
        Entries
    </div>

    <button class="tombol-tambah" onclick="openAddModal()">+ Add New</button>
</div>

<div class="table-header">
    <span>Manajemen Akun</span>
</div>

<table class="table-master">
<thead>
<tr>
    <th><input type="checkbox"></th>
    <th>Username</th>
    <th>Nama Pegawai</th>
    <th>Email</th>
    <th>Role</th>
    <th>Status</th>
    <th>Terakhir Login</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php while($d = mysqli_fetch_assoc($query)){ ?>
<tr>
    <td><input type="checkbox"></td> <!-- WAJIB ADA -->
    <td><?= $d['username']; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['email']; ?></td>
    <td><?= $d['role']; ?></td>

    <td class="<?= $d['is_active'] ? 'status-aktif':'status-nonaktif'; ?>">
        <?= $d['is_active'] ? 'Aktif':'Nonaktif'; ?>
    </td>

    <td><?= $d['last_login'] ?? '-'; ?></td>

    <td>
        <div class="aksi-btn">

            <a href="reset_password.php?id=<?= $d['id_user']; ?>" class="btn-reset">⟳</a>

            <?php if($d['is_active']){ ?>
                <a href="nonaktifkan.php?id=<?= $d['id_user']; ?>" class="btn-nonaktif">⛔</a>
            <?php } else { ?>
                <a href="aktifkan.php?id=<?= $d['id_user']; ?>" class="btn-aktifkan">▶</a>
            <?php } ?>

        </div>
    </td>
</tr>
<?php } ?>
</tbody>
</table>

<!-- =========================
     MODAL ADD USER
========================= -->
<div id="modalAdd" class="modal">
    <div class="modal-content">

        <h3 class="modal-title">Tambah Akun</h3>

        <form method="POST" class="form-akun">

            <!-- PEGAWAI -->
            <div class="form-group">
                <label>Pilih Pegawai</label>
                <select name="nip" required>
                    <option value="">-- Pilih Pegawai --</option>
                    <?php
                    $pegawai = mysqli_query($conn, "SELECT * FROM pegawai");
                    while($p = mysqli_fetch_assoc($pegawai)){
                        echo "<option value='".$p['nip']."'>".$p['nip']." - ".$p['nama_pegawai']."</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- USERNAME -->
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>

            <!-- EMAIL -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email">
            </div>

            <!-- ROLE -->
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="pegawai">Pegawai</option>
                </select>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="passwordInput" placeholder="Masukkan password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁</span>
                </div>
            </div>

            <!-- BUTTON -->
            <div class="form-actions">
                <button type="button" class="btn-batal" onclick="closeAddModal()">Batal</button>
                <button type="submit" name="tambah" class="btn-simpan">Simpan</button>
            </div>

        </form>

    </div>
</div>

</main>
<script>
function openAddModal(){
    document.getElementById("modalAdd").style.display = "block";
}
function closeAddModal(){
    document.getElementById("modalAdd").style.display = "none";
}
// password toggle
function togglePassword() {
    const input = document.getElementById("passwordInput");
    input.type = input.type === "password" ? "text" : "password";
}
</script>
<script src="../assets/core-ui.js"></script>
<script src="../assets/datamaster.js"></script>
<script src="../assets/admin-ui.js"></script>
</body>
</html>
