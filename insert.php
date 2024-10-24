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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="w-50 m-auto mt-5 h-100 card-body"
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
                <input type="number" class="form-control" id="exampleFormControlInput1" name="barang">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="jumlah">
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

<?php
include "conn.php";

//melakukan cek apakah form di submit 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $barang = $_POST['barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    $sql = "INSERT INTO muhammad_1 (nama, alamat, hp, tgl_transaksi, jenis_barang, nama_barang, jumlah, harga) VALUES ('$nama', '$alamat', '$hp', '$date', '$type', '$barang', '$jumlah', '$harga')";
    $mysqli->query($sql);
    if ($mysqli->affected_rows > 0) {
        header("Location: index.php");
    } else {
        echo `gagal` . $mysqli->error;
    }
}
?>