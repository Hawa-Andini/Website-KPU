// SIDEBAR BUKA / TUTUP
const sidebar = document.getElementById("sidebar");
const tombolMenu = document.getElementById("tombolMenu");

tombolMenu.addEventListener("click", () => {
    sidebar.classList.toggle("tertutup");

    if (sidebar.classList.contains("tertutup")) {
        tombolMenu.textContent = "<";
    } else {
        tombolMenu.textContent = "✕";
    }
});


// SUBMENU EDIT DATA 
const menuEditData = document.getElementById("menuEditData");
const submenuEditData = document.getElementById("submenuEditData");
const panahEditData = document.getElementById("panahEditData");

// Semua item menu utama
const semuaMenu = document.querySelectorAll(".item-menu");

menuEditData.addEventListener("click", function (e) {
    e.stopPropagation(); // supaya tidak bentrok

    const isAktif = submenuEditData.classList.contains("aktif");

    // Tutup semua submenu dulu
    submenuEditData.classList.remove("aktif");
    panahEditData.textContent = "▼";

    // Kalau sebelumnya belum aktif, buka lagi
    if (!isAktif) {
        submenuEditData.classList.add("aktif");
        panahEditData.textContent = "▲";
    }
});

// Kalau klik menu lain → otomatis tutup submenu
semuaMenu.forEach(menu => {
    if (menu !== menuEditData) {
        menu.addEventListener("click", function () {
            submenuEditData.classList.remove("aktif");
            panahEditData.textContent = "▼";
        });
    }
});

// TAB SWITCH
const tabs = document.querySelectorAll(".tab");
const contents = document.querySelectorAll(".tab-content");

tabs.forEach(tab => {
    tab.addEventListener("click", function () {

        tabs.forEach(t => t.classList.remove("aktif"));
        contents.forEach(c => c.classList.remove("aktif"));

        this.classList.add("aktif");
        document.getElementById(this.dataset.tab).classList.add("aktif");
    });
});

// TOMBOL LOG OUT 
const tombolKeluar = document.querySelector(".tombol-keluar");

tombolKeluar.addEventListener("click", () => {
    if (confirm("Apakah Anda yakin ingin keluar?")) {
        window.location.href = "Login.html";
    }
});

document.addEventListener("DOMContentLoaded", function () {

    // Simulasi data dari database
    const dataPegawai = {
        nama: "Hawa Andini Hadi",
        nip: "1987654321",
        pangkat: "Pembina IV/a",
        jabatan: "Kepala Sub Bagian",
        unitKerja: "Dinas Pendidikan",
        ringkasan: "Pegawai aktif dengan pengalaman lebih dari 10 tahun di bidang administrasi pemerintahan."
    };

    // Isi header
    document.getElementById("namaPegawai").textContent = dataPegawai.nama;
    document.getElementById("ringkasanPegawai").textContent = dataPegawai.ringkasan;

    // Isi form otomatis
    document.getElementById("fieldNama").value = dataPegawai.nama;
    document.getElementById("fieldNip").value = dataPegawai.nip;
    document.getElementById("fieldPangkat").value = dataPegawai.pangkat;
    document.getElementById("fieldJabatan").value = dataPegawai.jabatan;
    document.getElementById("fieldUnitKerja").value = dataPegawai.unitKerja;

});

document.querySelector(".tombol-tambah").addEventListener("click", function(e){
    e.preventDefault();

    // ambil nilai dari HTML yang sudah ada
    let golongan = document.querySelector("select").value;
    let tmt = document.querySelector('input[type="date"]').value;
    let tbody = document.querySelector(".tabel-riwayat tbody");

    if(golongan === "Pilih Golongan" || tmt === ""){
        alert("Isi dulu golongan dan TMT!");
        return;
    }

    // format tanggal dd-mm-yyyy
    let tgl = new Date(tmt);
    let hasilTanggal =
        String(tgl.getDate()).padStart(2,'0') + "-" +
        String(tgl.getMonth()+1).padStart(2,'0') + "-" +
        tgl.getFullYear();

    // tambah baris baru
    let tr = document.createElement("tr");

    tr.innerHTML = `
        <td>${golongan}</td>
        <td>${hasilTanggal}</td>
    `;

    tbody.appendChild(tr);
});
