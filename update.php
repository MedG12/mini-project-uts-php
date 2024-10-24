<?php
    include "conn.php";
    $id = $_GET['id'];
    $sql  = "SELECT * FROM muhammad_1 WHERE id_pembeli = $id";
    $result = $mysqli->query( $sql);

    // Jika form di-submit
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $hp = $_POST['hp'];
        $date = $_POST['date'];
        $type = $_POST['type'];
        $barang = $_POST['barang'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        

        // melakukan cek apakah file sudah ada
        $query = "UPDATE muhammad_1 SET nama = '$nama', alamat = '$alamat', hp = '$hp', tgl_transaksi = '$date', jenis_barang = '$type', nama_barang = '$barang', jumlah = '$jumlah', harga = '$harga' WHERE id_pembeli = $id";
        if($mysqli->query($query)){
            header("Location: index.php");
        } else {
            echo "Error updating record: " . mysqli_error($connect);
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="card min-vh-100">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class = "nav-item pe-3">
                    <h3>Record Penjualan</h3>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="create.php" >Add</a>
                </li>
            </ul>
        </div>

        <?php
        while($row = mysqli_fetch_array($result)){
            
        ?>
         <form action="<?php echo $_SERVER['PHP_SELF'];?>?id= <?php echo $row['id_pembeli'];?>" method="post" class="w-50 m-auto mt-5 h-100 card-body"
            enctype="multipart/form-data">
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="nama" value="<?php echo $row['nama']; ?>">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="alamat" value="<?php echo $row['alamat']; ?>">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">HP</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="hp" value="<?php echo $row['HP']; ?>">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" name="date" value="<?php echo $row['Tgl_Transaksi']; ?>">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Jenis Barang</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="type" value="<?php echo $row['Jenis_Barang']; ?>">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="barang" value="<?php echo $row['nama_barang']; ?>">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" name="jumlah" value="<?php echo $row['Jumlah']; ?>">
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label">Harga</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="harga" value="<?php echo $row['Harga']; ?>">
            </div>

            <input type="submit" class="btn btn-primary" name="submit" />
        </form>
        <?php
        }
        ?>
        
    </div>
  
</body>
</html>



