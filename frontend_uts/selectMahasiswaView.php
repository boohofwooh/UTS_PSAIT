<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
        }
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        .action-icons a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <h2>Nilai Mahasiswa</h2>
            <a href="insertMahasiswaView.php" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Add New</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nim</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nilai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_URL, 'http://localhost/api_uts/mahasiswa_api.php');
                        $res = curl_exec($curl);
                        $json = json_decode($res, true);

                        if (!empty($json['data'])) {
                            foreach ($json['data'] as $data) {
                                echo "<tr>";
                                echo "<td>{$data['nim']}</td>";
                                echo "<td>{$data['kode_mk']}</td>";
                                echo "<td>{$data['nilai']}</td>";
                                echo "<td class='action-icons'>";
                                echo "<a href='updateMahasiswaView.php?nim={$data['nim']}&kode_mk={$data['kode_mk']}' title='Update Record' class='mr-3'><span class='fa fa-pencil'></span></a>";
                                echo "<a href='deleteMahasiswaDo.php?nim={$data['nim']}&kode_mk={$data['kode_mk']}' title='Delete Record' onclick='return confirm(\"Are you sure you want to delete this record?\")'><span class='fa fa-trash'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No data available</td></tr>";
                        }
                        curl_close($curl);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
