<?php
if(isset($_POST['nim']) && isset($_POST['kode_mk']) && isset($_POST['nilai'])) {
    $nim = $_POST['nim'];
    $kode_mk = $_POST['kode_mk'];
    $nilai = $_POST['nilai'];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, 'http://localhost/api_uts/mahasiswa_api.php?nim=' . $nim . '&kode_mk=' . $kode_mk);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('nilai' => $nilai)));
    $res = curl_exec($curl);
    $json = json_decode($res, true);
    curl_close($curl);

    if($json['status'] == 1) {
        echo "Grade updated successfully.";
    } else {
        echo "Failed to update grade.";
    }
} else {
    echo "Nim, kode_mk, and nilai are not set.";
}
?>
<!-- Add a button that redirects to selectMahasiswaView.php -->
<a href="selectMahasiswaView.php" class="btn btn-primary">Back to Dashboard</a>
