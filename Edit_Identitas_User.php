<?php
$current = basename($_SERVER['PHP_SELF']);

$editPages = [
    'edit_identitas.php',
    'edit_riwayat_golongan.php',
    'edit_riwayat_jabatan.php',
    'edit_riwayat_pendidikan.php',
    'edit_riwayat_diklat.php',
    'edit_riwayat_keluarga.php',
    'edit_riwayat_kehormatan.php',
    'edit_riwayat_skp.php'
];

$isEditOpen = in_array($current, $editPages);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data – Identitas</title>

<style>
* { box-sizing: border-box; font-family: "Segoe UI", Tahoma, sans-serif; }

body { margin: 0; min-height: 100vh; display: flex; }

.sidebar {
    width: 260px;
    background: linear-gradient(to bottom, #8b0000, #3b0000);
    color: #fff;
    padding: 20px 15px;
    min-height: 100vh;
}

.logo {
    display: flex;
    justify-content: space-between;
    font-weight: bold;
    margin-bottom: 15px;
}

.menu-line {
    border: none;
    border-top: 1px solid rgba(255,255,255,0.35);
    margin: 12px 0;
}

.menu-item {
    padding: 8px 5px;
    font-weight: bold;
    text-align: center;
    position: relative;
}

.menu-item.active {
    text-decoration: underline;
}

.arrow {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}

.submenu {
    text-align: center;
}

.submenu-item {
    display: block;
    padding: 6px 0;
    font-size: 14px;
    color: rgba(255,200,200,.85);
    text-decoration: none;
}

.submenu-item.active {
    color: #fff;
    font-weight: bold;
}

.content {
    flex: 1;
    padding: 18px 40px;
}

.form-wrapper {
    display: flex;
    gap: 40px;
}

.photo-preview {
    width: 150px;
    height: 180px;
    background: #e0e0e0;
    margin-bottom: 10px;
}

.btn-upload {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 4px;
}

.form-row {
    display: grid;
    grid-template-columns: 260px 1fr;
    margin-bottom: 10px;
}

.form-row input {
    height: 28px;
    border: 1px solid #888;
}

.action-buttons {
    margin-top: 30px;
    display: flex;
    gap: 20px;
    justify-content: flex-end;
}

.btn-edit {
    background: #f1c40f;
    padding: 10px 24px;
    border: none;
    font-weight: bold;
}

.btn-delete {
    background: #c0392b;
    color: #fff;
    padding: 10px 24px;
    border: none;
    font-weight: bold;
}

.logout-btn {
    position: fixed;
    top: 20px;
    right: 25px;
    background: #7a0000;
    color: #fff;
    padding: 10px 18px;
    border-radius: 6px;
    border: none;
}
</style>
</head>

<body>

<form method="post" action="login.php">
    <button class="logout-btn">⎋ LOG OUT</button>
</form>

<aside class="sidebar">

    <div class="logo">LOGO</div>

    <hr class="menu-line">
    <div class="menu-item">Profil</div>
    <hr class="menu-line">

    <!-- EDIT DATA -->
    <div class="menu-item <?= $isEditOpen ? 'active' : '' ?>">
        Edit Data
        <span class="arrow"><?= $isEditOpen ? '▼' : '▶' ?></span>
    </div>

    <?php if ($isEditOpen): ?>
    <div class="submenu">
        <a href="edit_identitas.php" class="submenu-item <?= $current=='edit_identitas.php'?'active':'' ?>">Identitas</a>
        <a href="edit_riwayat_golongan.php" class="submenu-item <?= $current=='edit_riwayat_golongan.php'?'active':'' ?>">Riwayat Golongan</a>
        <a href="edit_riwayat_jabatan.php" class="submenu-item <?= $current=='edit_riwayat_jabatan.php'?'active':'' ?>">Riwayat Jabatan</a>
        <a href="edit_riwayat_pendidikan.php" class="submenu-item <?= $current=='edit_riwayat_pendidikan.php'?'active':'' ?>">Riwayat Pendidikan</a>
        <a href="edit_riwayat_diklat.php" class="submenu-item <?= $current=='edit_riwayat_diklat.php'?'active':'' ?>">Riwayat Diklat</a>
        <a href="edit_riwayat_keluarga.php" class="submenu-item <?= $current=='edit_riwayat_keluarga.php'?'active':'' ?>">Riwayat Keluarga</a>
        <a href="edit_riwayat_kehormatan.php" class="submenu-item <?= $current=='edit_riwayat_kehormatan.php'?'active':'' ?>">Riwayat Kehormatan</a>
        <a href="edit_riwayat_skp.php" class="submenu-item <?= $current=='edit_riwayat_skp.php'?'active':'' ?>">Riwayat SKP</a>
    </div>
    <?php endif; ?>

    <hr class="menu-line">
    <div class="menu-item">Pengaturan Akun</div>

</aside>

<main class="content">
    <h2>Identitas</h2>

    <div class="form-wrapper">
        <div>
            <div class="photo-preview"></div>
            <button class="btn-upload">UNGGAH FOTO</button>
        </div>

        <div>
            <?php
            $fields = [
                "Nama","NIP","Pangkat/Gol. Ruang/TMT","Jabatan Terakhir / TMT",
                "Tmt CPNS","Tmt PNS","Tempat & Tanggal Lahir",
                "Jenis Kelamin","Agama","Status Perkawinan",
                "Unit Kerja","Instansi","Alamat Rumah"
            ];
            foreach ($fields as $f):
            ?>
            <div class="form-row">
                <label><?= $f ?></label>
                <input>
            </div>
            <?php endforeach; ?>

            <div class="action-buttons">
                <button class="btn-edit">UBAH</button>
                <button class="btn-delete">HAPUS</button>
            </div>
        </div>
    </div>
</main>

</body>
</html>
