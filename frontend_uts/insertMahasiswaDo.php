<?php
// Periksa apakah tombol submit ditekan
if(isset($_POST['submit'])) {
    // Ambil data dari formulir
    $nim = $_POST['nim'];
    $kode_mk = $_POST['kode_mk'];
    $nilai = $_POST['nilai'];

    // Pastikan data yang diterima tidak kosong
    if(!empty($nim) && !empty($kode_mk) && !empty($nilai)) {
        // URL endpoint API untuk menyimpan data
        $url = 'http://localhost/api_uts/mahasiswa_api.php';

        // Data yang akan dikirim dalam format JSON
        $data = array(
            'nim' => $nim,
            'kode_mk' => $kode_mk,
            'nilai' => $nilai
        );

        // Encode data menjadi format JSON
        $jsonDataEncoded = json_encode($data);

        // Inisialisasi cURL
        $ch = curl_init($url);

        // Set opsi cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Eksekusi permintaan cURL
        $result = curl_exec($ch);

        // Periksa kode status HTTP untuk mengetahui apakah permintaan berhasil atau tidak
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode == 200) {
            // Data berhasil disimpan
            echo "<script>alert('Data berhasil disimpan.');</script>";
            echo "<script>window.location.href = 'selectMahasiswaView.php';</script>";
        } else {
            // Gagal menyimpan data
            echo "<script>alert('Gagal menyimpan data.');</script>";
            echo "<script>window.location.href = 'insertMahasiswaView.php';</script>";
        }

        // Tutup cURL
        curl_close($ch);
    } else {
        // Jika ada input yang kosong, tampilkan pesan kesalahan
        echo "<script>alert('Semua field harus diisi.');</script>";
        echo "<script>window.location.href = 'insertMahasiswaView.php';</script>";
    }
}
?>
