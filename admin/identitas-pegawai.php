<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['nip'])){
    header("location: ../auth/Login.php");
    exit;
}

// $nip = $_GET['nip'];
$nip = $_GET['nip'] ?? '';
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
  //  UBAH DATA PEGAWAI
if(isset($_POST['ubah'])){

$nama = $_POST['nama_pegawai'];
$instansi = "KPU Kota Surabaya";

$tempat_lahir  = ucwords($_POST['tempat_lahir']);
$tanggal_lahir = $_POST['tanggal_lahir'];

$jk     = $_POST['id_jenis_kelamin'];
$agama  = $_POST['id_agama'];
$status = $_POST['id_status_perkawinan'];
$unit   = $_POST['id_unit_kerja'];

$tipe_karyawan = $_POST['tipe_karyawan'];

$telp   = $_POST['no_telp'];
$alamat = $_POST['alamat'];

$tmt_cpns = $_POST['tmt_cpns'];
$tmt_pns  = $_POST['tmt_pns'];

$golongan = $_POST['id_gol'];
$tmt_gol  = $_POST['tmt_golongan'];

$jabatan = $_POST['id_jabatan'];
$tmt_jab = $_POST['tmt_jabatan'];

// UPLOAD FOTO
$updateFoto = "";

if (!empty($_FILES['foto']['name'])) {

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];

    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    // VALIDASI EXT
    if ($ext != "jpg" && $ext != "jpeg") {
        echo "<script>
        alert('Foto harus JPG/JPEG');
        window.history.back();
        </script>";
        exit;
    }

    // VALIDASI MIME
    $mime = mime_content_type($tmp);
    if(!in_array($mime, ['image/jpeg'])){
        echo "<script>
        alert('File harus JPG');
        window.history.back();
        </script>";
        exit;
    }

    // VALIDASI SIZE
    if ($size > 2000000)  {
        echo "<script>
        alert('Ukuran maksimal 2MB');
        window.history.back();
        </script>";
        exit;
    }

    $namaBaru = uniqid() . "." . $ext;
    $path = __DIR__ . "/../uploads/" . $namaBaru;

    // WAJIB CEK BERHASIL
    if(move_uploaded_file($tmp, $path)){
        $updateFoto = ", foto='uploads/$namaBaru'";
    } else {
        echo "<script>
        alert('Upload gagal');
        window.history.back();
        </script>";
        exit;
    }
}

mysqli_query($conn,"
UPDATE pegawai SET
nama_pegawai='$nama',
no_telp='$telp',
alamat='$alamat',
tmt_cpns='$tmt_cpns',
tmt_pns='$tmt_pns',
tipe_karyawan='$tipe_karyawan',
id_jenis_kelamin='$jk',
id_agama='$agama',
id_status_perkawinan='$status',
id_unit_kerja='$unit',
id_gol='$golongan',
tempat_lahir='$tempat_lahir',
tanggal_lahir='$tanggal_lahir'
$updateFoto
WHERE nip='$nip'
");



echo "<script>
alert('Data berhasil diubah');
window.location='Admin_Profil_Data_Pegawai.php';
</script>";

}

// HAPUS DATA PEGAWAI
if(isset($_POST['hapus'])){

mysqli_query($conn,"DELETE FROM pegawai WHERE nip='$nip'");

echo "<script>
alert('Data berhasil dihapus');
window.location='Admin_Profil_Data_Pegawai.php';
</script>";

}

$query = mysqli_query($conn,"
SELECT 
pegawai.*,
master_jenis_kelamin.jenis_kelamin,
master_agama.agama,
master_status_perkawinan.status_perkawinan,
master_divisi.unit_kerja,
master_golongan.nama_pangkat

FROM pegawai

LEFT JOIN master_jenis_kelamin 
ON pegawai.id_jenis_kelamin = master_jenis_kelamin.id_jenis_kelamin

LEFT JOIN master_agama 
ON pegawai.id_agama = master_agama.id_agama

LEFT JOIN master_status_perkawinan
ON pegawai.id_status_perkawinan = master_status_perkawinan.id_status_perkawinan

LEFT JOIN master_divisi
ON pegawai.id_unit_kerja = master_divisi.id_unit_kerja

LEFT JOIN master_golongan
ON pegawai.id_gol = master_golongan.id_gol

WHERE pegawai.nip='$nip'
");
$data = mysqli_fetch_array($query);
if(!$data){
    die("Data pegawai tidak ditemukan");
}
$jk = mysqli_query($conn,"SELECT * FROM master_jenis_kelamin");
$agama = mysqli_query($conn,"SELECT * FROM master_agama");
$status = mysqli_query($conn,"SELECT * FROM master_status_perkawinan");
$unit = mysqli_query($conn,"SELECT * FROM master_divisi");
$golongan = mysqli_query($conn,"SELECT * FROM master_golongan");
$jabatan = mysqli_query($conn,"SELECT * FROM master_jabatan");
$kabupaten = mysqli_query($conn,"SELECT * FROM master_kabupaten ORDER BY nama_kabupaten ASC");
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Identitas Pegawai</title>
    <link rel="stylesheet" href="../assets/style.css" />
    <link rel="stylesheet" href="../assets/edit_identitas.css" />
    

  </head>
  <body class="role-admin">
    <!-- SIDEBAR MINIMAL -->


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
      <a href="Admin_Manajemen_Akun.php" class="item-menu">
        Manajemen Akun
    </a>

    <hr class="garis-menu">
    </aside>

    

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
          <a href="Admin_Profil_Data_Pegawai.php">Beranda</a>
          <a href="#">Keluar</a>
        </div>
      </div>
    
      <div class="tab-menu">
    <a href="identitas-pegawai.php?nip=<?= $nip ?>" class="tab aktif">Identitas</a>
    <!-- <a href="Admin_Edit_Riwayat_Golongan.php" class="tab">Riwayat Golongan</a> -->
    <a href="Admin_Edit_Riwayat_Golongan.php?nip=<?= $nip ?>" class="tab">Riwayat Golongan</a>  
    <a href="Admin_Edit_Riwayat_Jabatan.php?nip=<?= $nip ?>" class="tab">Riwayat Jabatan</a>
    <a href="Admin_Edit_Riwayat_Pendidikan.php?nip=<?= $nip ?>" class="tab">Riwayat Pendidikan</a>
    <a href="Admin_Edit_Riwayat_Diklat.php?nip=<?= $nip ?>" class="tab">Riwayat Diklat</a>
    <a href="Admin_Edit_Riwayat_Keluarga.php?nip=<?= $nip ?>" class="tab">Riwayat Keluarga</a>
    <a href="Admin_Edit_Riwayat_Kehormatan.php?nip=<?= $nip ?>" class="tab">Riwayat Kehormatan</a>
    <a href="Admin_Edit_Riwayat_SKP.php?nip=<?= $nip ?>" class="tab">Riwayat SKP</a>
</div>

<form method="POST" enctype="multipart/form-data">
      <!-- FORM IDENTITAS -->
      <section class="form-identitas">
      
        
<div class="kotak-foto">

    <div class="pratinjau-foto">
        <img id="preview" class="foto-preview"
        src="<?= isset($data['foto']) ? '../' . $data['foto'] : '../uploads/default.png' ?>">
    </div>

    <label class="tombol-unggah">
        Unggah Foto
        <input type="file" name="foto" accept="image/jpeg"
               onchange="previewImage(event)" hidden>
    </label>

</div>

              <div class="form">
            <div class="baris-form">
<label>Nama</label>
<input name="nama_pegawai" value="<?= $data['nama_pegawai']; ?>">
</div>
            <div class="baris-form">
<label>NIP</label>
<!-- <input name="nip" value="<?= $data['nip']; ?>"> -->
 <input value="<?= $data['nip']; ?>" readonly>
<input type="hidden" name="nip" value="<?= $data['nip']; ?>">
</div>
            
<div class="baris-form">
  <label>Pangkat/Gol. Ruang/TMT</label>
  <div style="display:flex; gap:10px;">

<select name="id_gol">
<?php while($g = mysqli_fetch_assoc($golongan)){ ?>
    <option value="<?= $g['id_gol'] ?>"
    <?= ($data['id_gol'] == $g['id_gol']) ? 'selected' : '' ?>>
        <?= $g['nama_pangkat'] ?>
    </option>
<?php } ?>
</select>
<input type="date" name="tmt_golongan" value="<?= $data_gol['tmt_golongan'] ?? '' ?>">
</div>
</div>
            
<div class="baris-form">
<label>Jabatan Terakhir / TMT</label>

<div style="display:flex; gap:10px;">

<select name="id_jabatan">

<?php while($g = mysqli_fetch_assoc($jabatan)){ ?>

<option value="<?= $g['id_jabatan'] ?>"
<?php if(isset($data_jabatan['id_jabatan']) && $data_jabatan['id_jabatan']==$g['id_jabatan']) echo "selected"; ?>>

<?= $g['nama_jabatan'] ?> - <?= $g['jenis_jabatan'] ?>

</option>

<?php } ?>

</select>

<input type="date" name="tmt_jabatan"
value="<?= $data_jabatan['tmt_jabatan'] ?? '' ?>">

</div>
</div>
            
<div class="baris-form">
<label>TMT CPNS</label>
<input name="tmt_cpns" type="date" value="<?= $data['tmt_cpns']; ?>">
</div>
            
<div class="baris-form">
<label>TMT PNS</label>
<input name="tmt_pns" type="date" value="<?= $data['tmt_pns']; ?>">
</div>
            
<div class="baris-form">
<label>Tempat & Tanggal Lahir</label>

<div style="display:flex; gap:10px;">

<select name="tempat_lahir">
<option value="">-- Pilih Kabupaten --</option>

<?php while($row = mysqli_fetch_assoc($kabupaten)) { ?>
<option value="<?= $row['nama_kabupaten']; ?>"
<?= ($row['nama_kabupaten'] == $data['tempat_lahir']) ? 'selected' : ''; ?>>
<?= $row['nama_kabupaten']; ?>
</option>
<?php } ?>

</select>

<input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir']; ?>">

</div>
</div>
            
<div class="baris-form">
<label>Jenis Kelamin</label>
<select name="id_jenis_kelamin">
<?php while($k = mysqli_fetch_assoc($jk)){ ?>
    <option value="<?= $k['id_jenis_kelamin'] ?>"
    <?= ($data['id_jenis_kelamin'] == $k['id_jenis_kelamin']) ? 'selected' : '' ?>>
        <?= $k['jenis_kelamin'] ?>
    </option>
<?php } ?>
</select>
</div>
            
<div class="baris-form">
<label>Agama</label>
<select name="id_agama">
<?php while($a = mysqli_fetch_assoc($agama)){ ?>
    <option value="<?= $a['id_agama'] ?>"
    <?= ($data['id_agama'] == $a['id_agama']) ? 'selected' : '' ?>>
        <?= $a['agama'] ?>
    </option>
<?php } ?>
</select>
</div>
            <div class="baris-form">
<label>Status Perkawinan</label>
<select name="id_status_perkawinan">
<?php while($s = mysqli_fetch_assoc($status)){ ?>
    <option value="<?= $s['id_status_perkawinan'] ?>"
    <?= ($data['id_status_perkawinan'] == $s['id_status_perkawinan']) ? 'selected' : '' ?>>
        <?= $s['status_perkawinan'] ?>
    </option>
<?php } ?>
</select>
</div>
            
<div class="baris-form">
              
<label>Unit Kerja</label>
<select name="id_unit_kerja">
<?php while($u = mysqli_fetch_assoc($unit)){ ?>
    <option value="<?= $u['id_unit_kerja'] ?>"
    <?= ($data['id_unit_kerja'] == $u['id_unit_kerja']) ? 'selected' : '' ?>>
        <?= $u['unit_kerja'] ?>
    </option>
<?php } ?>
</select>            
</div>
            
<div class="baris-form">
   <label>Instansi</label>
        <input type="text" value="KPU Kota Surabaya" readonly>
        <input type="hidden" name="instansi" value="KPU Kota Surabaya">
</div>
            
<div class="baris-form">
                
<label>Tipe Karyawan</label>
                
<input type="text" name="tipe_karyawan"
value="<?= $data['tipe_karyawan'] ?? '' ?>"
placeholder="Contoh: PNS, CPNS, PPPK, dll">            
</div>

<div class="baris-form">
  <label>No. Telepon</label>
  <input name="no_telp" value="<?= $data['no_telp']; ?>">
</div>
            
<div class="baris-form">
  <label>Alamat Rumah</label>
  <input name="alamat" value="<?= $data['alamat']; ?>">
</div>
      <!-- TOMBOL -->

            <div class="aksi-form">
                <button type="submit" name="ubah" class="tombol-ubah">UBAH</button>
                <button type="submit" name="hapus" class="tombol-hapus">HAPUS</button>
            </div>
        </div>
    </form>

     
    </main>
    <!-- <script src="script.js"></script> -->

    <script>
      function previewImage(event) {
          const reader = new FileReader();
          reader.onload = function(){
              document.getElementById('preview').src = reader.result;
          }
          reader.readAsDataURL(event.target.files[0]);
      }
    </script>

    <script src="../assets/core-ui.js"></script>
    <script src="../assets/datamaster.js"></script>
    <script src="../assets/admin-ui.js"></script>

  </body>
</html>
