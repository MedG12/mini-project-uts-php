<?php
include "conn.php";
$errors = [];

//melakukan cek apakah form di submit 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = filter_var($_POST['nama'], FILTER_SANITIZE_STRING);
    $alamat = filter_var($_POST['alamat'], FILTER_SANITIZE_STRING);
    $hp = filter_var($_POST['hp'], FILTER_SANITIZE_STRING);
    $date = $_POST['date'];
    $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
    $barang = filter_var($_POST['barang'], FILTER_SANITIZE_STRING);
    $jumlah = filter_var($_POST['jumlah'], FILTER_SANITIZE_NUMBER_INT);
    $harga = filter_var($_POST['harga'], FILTER_SANITIZE_NUMBER_INT);
    $status = 0;



    $status = 1;

    // Fungsi validasi dasar
    function validateNotEmpty($value, $fieldName)
    {
        return strlen(trim($value)) > 0 ? null : "$fieldName harus diisi";
    }

    function validateNumeric($value, $fieldName)
    {
        return is_numeric($value) ? null : "$fieldName harus angka";
    }

    function validateAlpha($value, $fieldName)
    {
        return preg_match('/^[a-zA-Z\s]+$/', $value) ? null : "$fieldName hanya boleh berisi huruf";
    }

    // Validasi Nama
    if ($error = validateAlpha($nama, "Nama"))
        $errors[] = $error;
    if ($error = validateNotEmpty($nama, "Nama"))
        $errors[] = $error;

    // Validasi Alamat
    if ($error = validateNotEmpty($alamat, "Alamat"))
        $errors[] = $error;

    // Validasi Nomor HP
    if ($error = validateNumeric($hp, "No HP"))
        $errors[] = $error;
    if ($error = validateNotEmpty($hp, "HP"))
        $errors[] = $error;

    // Validasi Tanggal
    $d = DateTime::createFromFormat("Y-m-d", $date);
    if (!($d && $d->format("Y-m-d") === $date)) {
        $errors[] = "Format tanggal tidak valid. Gunakan format YYYY-MM-DD.";
    }

    // Validasi Jenis Barang
    if ($error = validateNotEmpty($type, "Jenis Barang"))
        $errors[] = $error;

    // Validasi Nama Barang
    if ($error = validateNotEmpty($barang, "Nama Barang"))
        $errors[] = $error;

    // Validasi Jumlah dan Harga
    if ($error = validateNumeric($jumlah, "Jumlah"))
        $errors[] = $error;
    if ($error = validateNumeric($harga, "Harga"))
        $errors[] = $error;

    // melakukan cek apakah masih ada error
    if (empty($errors)) {
        $sql = "INSERT INTO muhammad_1 (nama, alamat, hp, tgl_transaksi, jenis_barang, nama_barang, jumlah, harga) VALUES ('$nama', '$alamat', '$hp', '$date', '$type', '$barang', '$jumlah', '$harga')";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            header("Location: index.php");
        } else {
            echo `gagal` . $mysqli->error;
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="card min-vh-100">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item pe-3">
                    <h3>Record Penjualan</h3>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="create.php">Add</a>
                </li>
            </ul>
        </div>
        <div
            class="error-message bg-danger-subtle w-50 mx-auto mt-5 mb-0 d-<?php echo empty($errors) ? 'none' : 'block'; ?> p-3">
            <h1 class="my-3">Warning</h1>
            <ul>
                <?php 
                foreach ($errors as $error) {
                    echo "<li>  $error  </li>";
                } 
                ?>
            </ul>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="w-50 m-auto h-100 card-body"
            enctype="multipart/form-data">
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="nama">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="alamat">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">HP</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="hp">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" name="date">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Jenis Barang</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="type">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="barang">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" name="jumlah">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Harga</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="harga">
            </div>

            <input type="submit" class="btn btn-primary" name="submit" />
        </form>
    </div>

</body>

</html>