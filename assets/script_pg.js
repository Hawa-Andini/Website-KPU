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

// DROPDOWN USER PROFILE
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
//LOGOUT
function openLogoutModal() {
    document.getElementById("modalLogout").style.display = "flex";
}

function closeLogoutModal() {
    document.getElementById("modalLogout").style.display = "none";
}

// IDENTITAS
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function autoSubmit() {
    document.getElementById('formUpload').submit();
}

function autoSubmit() {
    document.getElementById('formUpload').submit();
}
