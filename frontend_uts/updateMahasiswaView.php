<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Grade</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Update Grade</h2>
        <?php
        if(isset($_GET['nim']) && isset($_GET['kode_mk'])) {
            $nim = $_GET['nim'];
            $kode_mk = $_GET['kode_mk'];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, 'http://localhost/api_uts/mahasiswa_api.php?nim=' . $nim . '&kode_mk=' . $kode_mk);
            $res = curl_exec($curl);
            $json = json_decode($res, true);
            curl_close($curl);

            if (!empty($json['data'])) {
                $nilai = $json['data'][0]['nilai'];
            } else {
                echo "No data found for the given nim and kode_mk.";
                exit;
            }
        } else {
            echo "Nim and kode_mk are not set.";
            exit;
        }
        ?>
        <form action="updateMahasiswaDo.php" method="post">
            <input type="hidden" name="nim" value="<?php echo $nim; ?>">
            <input type="hidden" name="kode_mk" value="<?php echo $kode_mk; ?>">
            <div class="form-group">
                <label for="nilai">Nilai:</label>
                <input type="text" id="nilai" name="nilai" class="form-control" value="<?php echo $nilai; ?>">
            </div>
            <input type="submit" class="btn btn-primary" value="Update">
        </form>
    </div>
</body>
</html>
