document.addEventListener("DOMContentLoaded", function () {

    // ===============================
    // TAB SWITCH (AMAN)
    // ===============================
    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".tab-content");

    if (tabs.length > 0 && contents.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener("click", function () {

                tabs.forEach(t => t.classList.remove("aktif"));
                contents.forEach(c => c.classList.remove("aktif"));

                this.classList.add("aktif");

                const target = document.getElementById(this.dataset.tab);
                if (target) target.classList.add("aktif");
            });
        });
    }

    // ===============================
    // FORMAT TELP SAAT LOAD
    // ===============================
    const inputTelp = document.querySelector("input[name='no_telp']");
    if (inputTelp && inputTelp.value) {
        formatTelp(inputTelp);
    }

});


// ===============================
// LOGOUT
// ===============================
function openLogoutModal() {
    const modal = document.getElementById("modalLogout");
    if (modal) modal.style.display = "flex";
}

function closeLogoutModal() {
    const modal = document.getElementById("modalLogout");
    if (modal) modal.style.display = "none";
}


// ===============================
// PREVIEW FOTO
// ===============================
function previewImage(event) {
    const file = event.target.files[0];

    if (!file) return;

    const maxSize = 2 * 1024 * 1024;

    if (file.size > maxSize) {
        showErrorModal("Ukuran foto maksimal 2MB!");
        event.target.value = "";
        return;
    }

    const reader = new FileReader();
    reader.onload = function () {
        const img = document.getElementById('preview');
        if (img) img.src = reader.result;
    };
    reader.readAsDataURL(file);
}


// ===============================
// MODAL ERROR
// ===============================
function showErrorModal(pesan) {
    const text = document.getElementById("errorText");
    const modal = document.getElementById("modalError");

    if (text) text.innerText = pesan;
    if (modal) modal.style.display = "flex";
}

function closeErrorModal() {
    const modal = document.getElementById("modalError");
    if (modal) modal.style.display = "none";
}


// ===============================
// MODAL AKSI
// ===============================
function openModalAksi(judul, pesan, tipe, aksiOK = null) {

    const modal = document.getElementById("modalAksi");
    const title = document.getElementById("judulAksi");
    const isi = document.getElementById("isiAksi");
    const btnOK = document.getElementById("btnOKAksi");
    const btnBatal = document.getElementById("btnBatalAksi");

    if (!modal || !title || !isi || !btnOK || !btnBatal) return;

    modal.style.display = "flex";
    title.innerText = judul;
    isi.innerText = pesan;

    btnOK.onclick = null;
    btnBatal.onclick = null;

    btnOK.className = "tombol-tambah";
    btnBatal.style.display = "none";

    btnOK.onclick = closeModalAksi;

    if (tipe === "confirm") {
        btnBatal.style.display = "inline-block";
        btnOK.className = "tombol-hapus";

        btnOK.onclick = function () {
            if (aksiOK) aksiOK();
            closeModalAksi();
        };

        btnBatal.onclick = closeModalAksi;
    }
}

function closeModalAksi() {
    const modal = document.getElementById("modalAksi");
    if (modal) modal.style.display = "none";
}


// ===============================
// FORMAT TELP
// ===============================
function formatTelp(input) {

    let angka = input.value.replace(/\D/g, '');

    let format = angka;

    if (angka.length > 4 && angka.length <= 8) {
        format = angka.substring(0, 4) + '-' + angka.substring(4);
    } 
    else if (angka.length > 8) {
        format = angka.substring(0, 4) + '-' + angka.substring(4, 8) + '-' + angka.substring(8);
    }

    input.value = format;
}

// ===============================
// HELPER VALIDASI (TARUH DI SINI)
// ===============================
function cekKosong(fieldList) {
    let kosong = [];
  
    fieldList.forEach(name => {
      let el = document.querySelector(`[name="${name}"]`);
  
      if (!el) {
        console.warn("Field tidak ditemukan:", name);
        return;
      }
  
      if (!el.value || el.value === "0") {
        kosong.push(name);
    }
    });
  
    return kosong;
  }

// ===============================
// TAMBAH DATA
// ===============================
async function klikTambah() {

    // VALIDASI NIP
    let nip = document.querySelector("input[name='nip']").value.trim();

    if (nip.length !== 18) {
        openModalAksi("Peringatan", "NIP harus 18 digit!", "info");
        return;
    }

    if (!/^\d+$/.test(nip)) {
        openModalAksi("Peringatan", "NIP harus berupa angka!", "info");
        return;
    }

        // 🔥 CEK NIP KE DATABASE (DITARUH DI SINI)
        let response = await fetch("cek_nip.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "nip=" + encodeURIComponent(nip)
        });
    
        let result = await response.text();
    
        if (result === "duplikat") {
            openModalAksi("Gagal", "NIP sudah terdaftar!", "info");
            return;
        }
    
    

    // VALIDASI FOTO
    let foto = document.querySelector("input[name='foto']");
    if (!foto || foto.files.length === 0) {
        openModalAksi("Peringatan", "Foto wajib diunggah!", "info");
        return;
    }

// VALIDASI TELEPON
let telpInput = document.querySelector("input[name='no_telp']");
let telpAngka = telpInput.value.trim().replace(/\D/g, '');

if (telpAngka.length === 0) {
    openModalAksi("Peringatan", "Nomor telepon tidak boleh kosong!", "info");
    return;
}

if (telpAngka.length > 13) {
    openModalAksi("Peringatan", "Nomor telepon terlalu panjang!", "info");
    return;
}

if (telpAngka.length < 10) {
    openModalAksi("Peringatan", "Nomor telepon terlalu pendek!", "info");
    return;
}

if (!telpAngka.startsWith("08")) {
    openModalAksi("Peringatan", "Nomor telepon harus diawali 08!", "info");
    return;
}

// format tampilan
telpInput.value = telpAngka;
formatTelp(telpInput);


// VALIDASI FIELD WAJIB
let wajibUtama = [
    "nama_pegawai",
    "nip",
    "tempat_lahir",
    "tanggal_lahir",
    "id_jenis_kelamin",
    "id_agama",
    "id_status_perkawinan",
    "id_unit_kerja",
    "tipe_karyawan",
    "no_telp",
    "alamat"
];

let kosongUtama = cekKosong(wajibUtama);

if (kosongUtama.length > 0) {
    openModalAksi(
        "Peringatan",
        "Lengkapi data utama terlebih dahulu!",
        "info"
    );
    return;
}

let wajibRiwayat = [
    "id_gol",
    "tmt_golongan",
    "id_jabatan",
    "tmt_jabatan",
    "id_jenjang_pend",
    "institusi",
    "tahun_lulus"
];

let kosongRiwayat = cekKosong(wajibRiwayat);

if (kosongRiwayat.length > 0) {
    openModalAksi(
        "Peringatan",
        "Riwayat wajib diisi terlebih dahulu!",
        "info"
    );
    return;
}

    // KONFIRMASI
    openModalAksi(
        "Konfirmasi",
        "Apakah Anda ingin menambahkan data?",
        "confirm",
        function () {
            let form = document.getElementById("formUpload");

            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "tambah";
            input.value = "1";

            form.appendChild(input);
            form.submit();
        }
    );
}