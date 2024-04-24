<?php
require_once "config.php";

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["nim"])) {
            $nim = $_GET["nim"];
            get_nilai_mahasiswa($nim);
        } else {
            get_all_nilai_mahasiswa();
        }
        break;
    case 'POST':
        if (!empty($_POST["nim"]) && !empty($_POST["kode_mk"]) && !empty($_POST["nilai"])) {
            $nim = $_POST["nim"];
            $kode_mk = $_POST["kode_mk"];
            $nilai = $_POST["nilai"];
            insert_nilai_mahasiswa($nim, $kode_mk, $nilai);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array("status" => 0, "message" => "Parameter missing"));
        }
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        if (!empty($_GET["nim"]) && !empty($_GET["kode_mk"]) && isset($_PUT["nilai"])) {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            $nilai = $_PUT["nilai"];
            update_nilai_mahasiswa($nim, $kode_mk, $nilai);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array("status" => 0, "message" => "Parameter missing"));
        }
        break;          
    case 'DELETE':
        if (!empty($_GET["nim"]) && !empty($_GET["kode_mk"])) {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            delete_nilai_mahasiswa($nim, $kode_mk);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array("status" => 0, "message" => "Parameter missing"));
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Function to get all nilai mahasiswa
function get_all_nilai_mahasiswa()
{
    global $mysqli;
    $query = "SELECT * FROM perkuliahan";
    $data = array();
    $result = $mysqli->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get List Nilai Mahasiswa Successfully.',
            'data' => $data
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Failed to retrieve data from database.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Function to get nilai mahasiswa by nim
function get_nilai_mahasiswa($nim)
{
    global $mysqli;
    $query = "SELECT * FROM perkuliahan WHERE nim = '$nim'";
    $data = array();
    $result = $mysqli->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get Nilai Mahasiswa Successfully.',
            'data' => $data
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Failed to retrieve data from database.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Function to insert new nilai mahasiswa
function insert_nilai_mahasiswa($nim, $kode_mk, $nilai)
{
    global $mysqli;
    $query = "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', '$nilai')";
    if ($mysqli->query($query) === TRUE) {
        $response = array(
            'status' => 1,
            'message' => 'Nilai Mahasiswa Inserted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Failed to Insert Nilai Mahasiswa.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
// Function to update nilai mahasiswa
function update_nilai_mahasiswa($nim, $kode_mk, $nilai)
{
    global $mysqli;
    $query = "UPDATE perkuliahan SET nilai = '$nilai' WHERE nim = '$nim' AND kode_mk = '$kode_mk'";
    if ($mysqli->query($query) === TRUE) {
        $response = array(
            'status' => 1,
            'message' => 'Nilai Mahasiswa Updated Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Failed to Update Nilai Mahasiswa.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Function to delete nilai mahasiswa by nim and kode_mk
function delete_nilai_mahasiswa($nim, $kode_mk)
{
    global $mysqli;
    $query = "DELETE FROM perkuliahan WHERE nim = '$nim' AND kode_mk = '$kode_mk'";
    if ($mysqli->query($query) === TRUE) {
        $response = array(
            'status' => 1,
            'message' => 'Nilai Mahasiswa Deleted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Failed to Delete Nilai Mahasiswa.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
