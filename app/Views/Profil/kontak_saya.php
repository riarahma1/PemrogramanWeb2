<!DOCTYPE html>
<html>
  <head>
    <title>Kontak Saya</title>
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">
  </head>
  <body>
    <form action="kontak_saya" method="post">
      <h2>Kontak Saya</h2>
      <br>
      <fieldset>
        <label for="namapengontak">Nama Pengontak</label>
        <input type="text" id="namapengontak" name="namapengontak" required />

        <label for="perusahaan">Perusahaan</label>
        <input type="text" id="perusahaan" name="perusahaan" required />

        <label for="alasanmengontak">Alasan Mengontak</label>
        <select id="alasanmengontak" name="alasanmengontak" required>
          <option value="kerjasama">Kerjasama</option>
          <option value="pertanyaan">Pertanyaan</option>
          <option value="lainnya">Lainnya</option>
        </select>

        <button type="submit">Kirim</button>
      </fieldset>
    </form>

    <script>
      function kirimKeWA(event) {
        event.preventDefault(); // Mencegah form submit biasa

        const nama = document.getElementById("namapengontak").value.trim();
        const perusahaan = document.getElementById("perusahaan").value.trim();
        const alasan = document.getElementById("alasanmengontak").value.trim();

        if (!nama || !perusahaan || !alasan) {
          alert("Semua kolom harus diisi!");
          return;
        }

        const pesan = `Halo, saya ${nama} dari ${perusahaan}. Saya ingin mengontak Anda untuk alasan: ${alasan}.`;
        const nomorWA = "6285606404271"; // Tanpa tanda + untuk wa.me
        const urlWA = `https://wa.me/${nomorWA}?text=${encodeURIComponent(pesan)}`;
        window.open(urlWA, "_blank");
      }

      window.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector("form");
        form.addEventListener("submit", kirimKeWA);
      });
    </script>
  </body>
</html>
