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
<body class="role-admin">
    
<!-- SIDEBAR -->
<aside class="sidebar-edit">
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

      <a href="Admin_Pengaturan_Akun.php" class="item-menu aktif">
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
<?php include '../pegawai/Notifikasi_Logout.php'; ?>

<script>
  document.addEventListener("DOMContentLoaded", function () {

// SIDEBAR TOGGLE
const tombolMenu = document.getElementById("tombolMenu");
const sidebar = document.querySelector(".sidebar-edit");

if (tombolMenu && sidebar) {
    tombolMenu.addEventListener("click", function () {

        sidebar.classList.toggle("tertutup");

        tombolMenu.textContent = sidebar.classList.contains("tertutup")
            ? "<"
            : "✕";
    });
}

// DROPDOWN USER PROFILE
const userProfile = document.getElementById("userProfile");

if (userProfile) {

    userProfile.addEventListener("click", function (e) {
        e.stopPropagation();
        userProfile.classList.toggle("active");
    });

    document.addEventListener("click", function (e) {
        if (!userProfile.contains(e.target)) {
            userProfile.classList.remove("active");
        }
    });

}

// TAB SWITCH
const tabs = document.querySelectorAll(".tab");
const contents = document.querySelectorAll(".tab-content");

if (tabs.length > 0) {

    tabs.forEach(tab => {

        tab.addEventListener("click", function () {

            tabs.forEach(t => t.classList.remove("aktif"));
            contents.forEach(c => c.classList.remove("aktif"));

            this.classList.add("aktif");

            const target = this.dataset.tab;
            document.getElementById(target).classList.add("aktif");

        });

    });

}

// LOGOUT MODAL
function openLogoutModal() {
    document.getElementById("modalLogout").style.display = "flex";
}

function closeLogoutModal() {
    document.getElementById("modalLogout").style.display = "none";
}

});
</script>

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
