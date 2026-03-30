<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['nip'])){
    header("Location: Login.php");
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

// UPDATE PASSWORD
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

        } else {
            $pesan = "Konfirmasi password tidak cocok";;
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
    <link rel="stylesheet" href="style.css">
<style>
.sidebar-edit {
    width: 179px;
    background: linear-gradient(to bottom, #8b0000, #3b0000);
    color: #fff;
    padding: 20px 15px;
    min-height: 100vh;
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
/* Hilangkan efek visited */
.sidebar-edit .item-menu:visited {
    color: #fff !important;
    text-decoration: none;
}

/* Aktif pakai underline */
.sidebar-edit .item-menu.aktif {
    text-decoration: underline;
}

/* SIDEBAR TERTUTUP  */
.sidebar-edit.tertutup {
    width: 60px;
    padding: 20px 5px;
}

/* SEMBUNYIKAN SEMUA ISI SIDEBAR */
.sidebar-edit.tertutup .logo span,
.sidebar-edit.tertutup .item-menu,
.sidebar-edit.tertutup .submenu,
.sidebar-edit.tertutup .item-submenu,
.sidebar-edit.tertutup .garis-menu {
    display: none !important;
}

/* TOMBOL < HARUS TETAP MUNCUL */
.sidebar-edit.tertutup .tombol-menu {
    display: block;
    margin: 0 auto;
}

.konten-akun{
    flex:1;
    position: relative;  
    padding: 20px 40px 30px 40px; /* kiri kanan sama */
    box-sizing: border-box;
}
.konten-akun h2{
    margin-top: 0;
    margin-bottom: 20px;
}
.konten-akun .aksi-form {
    display: flex;
    justify-content: flex-end;
}
.konten-akun .kelompok-form {
    width: 100%;
}

.konten-akun .kelompok-form input {
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box;
}

.konten-akun .tab-container {
    width: 100%;
}
.kelompok-form {
    display: flex;
    flex-direction: column;
    margin-bottom: 18px;
}

.kelompok-form label {
    margin-bottom: 6px;
}

.kelompok-form input {
    height: 36px;
    border: 1px solid #888;
    padding: 6px 10px;
    width: 90% !important;
}
.input-password {
    position: relative;
}

.input-password input {
    width: 100%;
    padding-right: 40px;
}

.input-password span {
    position: absolute;
    right: 10px;
    top: 8px;
    cursor: pointer;
}
.tab-container {
    display: flex;
    border-bottom: 2px solid #999;
    margin-bottom: 40px;
}

.tab {
    flex: 1; 
    text-align: center;
    padding: 12px 0;
    cursor: pointer;
    font-weight: 500;
    position: relative;
}

.tab.aktif {
    font-weight: bold;
}

.tab.aktif::after {
    content: "";
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 3px;
    background: #8b0000;
}

.tab-content {
    display: none;
}

.tab-content.aktif {
    display: block;
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
              <a href="#">Beranda</a>
              <a href="#">Keluar</a>
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
                <label>Nama Lengkap</label>
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

</main>
<script src="script.js"></script>
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
