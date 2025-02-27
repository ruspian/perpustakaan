document.addEventListener("DOMContentLoaded", function () {
  const btnTambahBuku = document.getElementById("btnTambahBuku");
  const formContainer = document.getElementById("formContainer");
  const formEditContainer = document.getElementById("formEditContainer");

  if (!btnTambahBuku || !formContainer || !formEditContainer) {
    console.error("❌ ERROR: Elemen tidak ditemukan! Cek ID di HTML.");
    return;
  }

  // Toggle Form Tambah Buku
  btnTambahBuku.addEventListener("click", function () {
    formContainer.style.display =
      formContainer.style.display === "none" ||
      formContainer.style.display === ""
        ? "block"
        : "none";
    formEditContainer.style.display = "none"; // Sembunyikan form edit jika ada
  });
});

// Fungsi untuk menampilkan/sembunyikan form edit
function tampilFormEdit(id, nama, penulis, tahun, deskripsi) {
  const formEditContainer = document.getElementById("formEditContainer");
  const formContainer = document.getElementById("formContainer");

  if (!formEditContainer || !formContainer) {
    console.error("❌ ERROR: Form tidak ditemukan! Cek ID di HTML.");
    return;
  }

  // Jika form edit sudah tampil, maka sembunyikan
  if (formEditContainer.style.display === "block") {
    formEditContainer.style.display = "none";
  } else {
    // Jika form edit belum tampil, isi dan tampilkan
    document.getElementById("editIdBuku").value = id;
    document.getElementById("editNamaBuku").value = nama;
    document.getElementById("editPenulis").value = penulis;
    document.getElementById("editTahun").value = tahun;
    document.getElementById("editDesc").value = deskripsi;

    formContainer.style.display = "none"; // Sembunyikan form tambah
    formEditContainer.style.display = "block"; // Tampilkan form edit
  }
}

document.getElementById("filterJumlah").addEventListener("change", function () {
  let jumlah = this.value;
  window.location.href = `?limit=${jumlah}`;
});

// Pencarian tanpa reload
document.getElementById("search-input").addEventListener("keyup", function () {
  let query = this.value.toLowerCase();
  let rows = document.querySelectorAll("#daftarBuku tr");

  rows.forEach((row) => {
    let namaBuku = row.children[2].textContent.toLowerCase();
    let penulis = row.children[3].textContent.toLowerCase();
    let tahun = row.children[4].textContent.toLowerCase();

    if (
      namaBuku.includes(query) ||
      penulis.includes(query) ||
      tahun.includes(query)
    ) {
      row.style.display = "";
    } else {
      row.style.display = "none";
      alert("Data tidak ditemukan");
    }
  });
});
