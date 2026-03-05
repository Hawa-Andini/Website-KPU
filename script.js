document.addEventListener("DOMContentLoaded", function () {

// SIDEBAR BUKA / TUTUP 
const tombolMenu = document.getElementById("tombolMenu");

// Cari sidebar yang ada di halaman ini
const sidebar =
    document.getElementById("sidebar") ||
    document.querySelector(".sidebar-edit");

if (tombolMenu && sidebar) {
    tombolMenu.addEventListener("click", () => {
        sidebar.classList.toggle("tertutup");

        tombolMenu.textContent = sidebar.classList.contains("tertutup")
            ? "<"
            : "✕";
    });
}
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

const tombolTambah = document.querySelector(".tombol-tambah");

if (tombolTambah) {
    tombolTambah.addEventListener("click", function(e){
        e.preventDefault();

        const select = document.querySelector("select");
        const inputDate = document.querySelector('input[type="date"]');
        const tbody = document.querySelector(".tabel-riwayat tbody");

        // STOP kalau elemen tidak lengkap
        if (!select || !inputDate || !tbody) {
            console.warn("Elemen form riwayat tidak lengkap.");
            return;
        }

        let golongan = select.value;
        let tmt = inputDate.value;

        if(golongan === "Pilih Golongan" || tmt === ""){
            alert("Isi dulu golongan dan TMT!");
            return;
        }

        let tgl = new Date(tmt);
        let hasilTanggal =
            String(tgl.getDate()).padStart(2,'0') + "-" +
            String(tgl.getMonth()+1).padStart(2,'0') + "-" +
            tgl.getFullYear();

        let tr = document.createElement("tr");

        tr.innerHTML = `
            <td>${golongan}</td>
            <td>${hasilTanggal}</td>
        `;

        tbody.appendChild(tr);

        inputDate.value = "";
        select.selectedIndex = 0;
    });
}

   // DROPDOWN USER PROFILE
    // ===============================
    const userProfile = document.getElementById("userProfile");

    if (userProfile) {

        userProfile.addEventListener("click", function (e) {
            e.stopPropagation(); // supaya tidak langsung tertutup
            userProfile.classList.toggle("active");
        });

        document.addEventListener("click", function (e) {
            if (!userProfile.contains(e.target)) {
                userProfile.classList.remove("active");
            }
        });
    }
});
