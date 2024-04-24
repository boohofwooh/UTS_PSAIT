<?php

if(isset($_GET['nim'])) {
    $nim = $_GET['nim'];
} else {
    $nim = "";
}


if(isset($_GET['kode_mk'])) {
    $kode_mk = $_GET['kode_mk'];
} else {
    $kode_mk = "";
}

$url = 'http://localhost/api_uts/mahasiswa_api.php?nim=' . $nim . '&kode_mk=' . $kode_mk;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

echo "<center><br>status : {$result["status"]} ";
echo "<br>";
echo "message : {$result["message"]} ";
echo "<br><a href=selectMahasiswaView.php> OK </a>";
?>
