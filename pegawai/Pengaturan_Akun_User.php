<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['nip'])){
    header("location: ../auth/Login.php");
    exit;
}

$nip = $_SESSION['nip'];

$stmt = $conn->prepare("
    SELECT u.*, p.nama_pegawai, p.no_telp
    FROM user u
    JOIN pegawai p ON u.nip = p.nip
    WHERE u.nip=?
");
$stmt->bind_param("s", $nip);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// UPDATE DATA
if(isset($_POST['update_data'])){

    $username = $_POST['nama'];
    $email    = $_POST['email'];
    $telepon  = $_POST['telepon'];

    $stmt = $conn->prepare("
        UPDATE user u
        JOIN pegawai p ON u.nip = p.nip
        SET 
            u.username = ?, 
            u.email = ?, 
            p.no_telp = ?
        WHERE u.nip = ?
    ");

    $stmt->bind_param("ssss", $username, $email, $telepon, $nip);
    $stmt->execute();

    $pesan = "Data berhasil diperbarui";
}

// UPDATE PASSWORD
$pesan = "";

if(isset($_POST['update_password'])){
    $pass_lama = $_POST['pass_lama'];
    $pass_baru = $_POST['pass_baru'];
    $konfirmasi = $_POST['konfirmasi'];

    if($pass_lama == $user['password']){
        if($pass_baru == $konfirmasi){

            $stmt = $conn->prepare("
                UPDATE user SET password=? WHERE nip=?
            ");
            $stmt->bind_param("ss", $pass_baru, $nip);
            $stmt->execute();

            $pesan = "Password berhasil diubah";

        } else {
            $pesan = "Konfirmasi password tidak cocok";
        }
    } else {
        $pesan = "Password lama salah";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Akun</title>
    <link rel="stylesheet" href="../assets/style_edit.css">
    <link rel="stylesheet" href="../assets/style_tab.css">
</head>
<body class="role-user">
    
<!-- SIDEBAR -->
<aside class="sidebar-edit">
    <div class="logo">
        <span>LOGO</span>
        <button class="tombol-menu" id="tombolMenu">✕</button>
    </div>

    <hr class="garis-menu">

    <a href="Identitas_User.php" class="item-menu">Profil</a>
  
    <hr class="garis-menu">

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
    <hr class="garis-menu">

    <div class="item-menu aktif">Pengaturan Akun</div>

    <hr class="garis-menu">
</aside>

<!-- KONTEN -->
<main class="konten-akun">
    <h2>Pengaturan Akun</h2>

         <div class="user-profile" id="userProfile">
                <div class="user-info">
                  <div class="user-icon">👤</div>
                  <div class="user-name">
                  <?= $user['nama_pegawai'] ?>
                  </div>
                </div>
    
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="Identitas_User.php">Beranda</a>
                    <a href="#" onclick="openLogoutModal()">Keluar</a>
                </div>
          </div>
        <!-- TAB -->
        <div class="tab-container">
            <div class="tab aktif" data-tab="data">Data Pribadi</div>
            <div class="tab" data-tab="password">Kata Sandi</div>
        </div>

        <!-- DATA PRIBADI -->
        <div class="tab-content aktif" id="data">
        <form method="POST">
            <div class="kelompok-form">
                <label>Username</label>
                <input name="nama" value="<?= $user['username'] ?>">
            </div>

            <div class="kelompok-form">
                <label>Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?>">
            </div>

            <div class="kelompok-form">
                <label>Telepon</label>
                <input name="telepon" value="<?= $user['no_telp'] ?>">
            </div>

            <div class="aksi-form">
                <button name="update_data" class="tombol-ubah">PERBARUI</button>
            </div>
        </form>
        </div>

        <!-- PASSWORD -->
        <div class="tab-content" id="password">
        <form method="POST">
        <div class="kelompok-form password-wrapper">
            <label>Password Lama</label>
            <div class="input-password">
                <input type="password" name="pass_lama" id="pass_lama">
                <span onclick="togglePassword('pass_lama')">👁</span>
            </div>
        </div>

        <div class="kelompok-form password-wrapper">
            <label>Password Baru</label>
            <div class="input-password">
                <input type="password" name="pass_baru" id="pass_baru">
                <span onclick="togglePassword('pass_baru')">👁</span>
            </div>
        </div>

        <div class="kelompok-form password-wrapper">
            <label>Konfirmasi Password</label>
            <div class="input-password">
                <input type="password" name="konfirmasi" id="konfirmasi">
                <span onclick="togglePassword('konfirmasi')">👁</span>
            </div>
        </div>
        
        <div class="aksi-form">
            <button name="update_password" class="tombol-ubah">PERBARUI</button>
        </div>
        </form>
        </div>
        <div id="notifModal" class="modal">
        <div class="modal-content">
            <p id="isiPesan"></p>
            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
            <button onclick="closeNotif()"class="tombol-tambah">OK</button>
        </div>
        </div>
    </div>

</main>
<?php include 'Notifikasi_Logout.php'; ?>

<script src="../assets/script_pg.js"></script>

<script>
function togglePassword(id){
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}

function closeNotif(){
    document.getElementById("notifModal").style.display = "none";
}

<?php if(!empty($pesan)): ?>
document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("isiPesan").innerText = "<?= $pesan ?>";
    document.getElementById("notifModal").style.display = "flex";
});
<?php endif; ?>
</script>
</body>
</html>
