<?php
include("conn.php");
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
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="insert.php">Add</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <form class="d-flex m-3 ms-0" role="search" action="index.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                    name="search_query">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['search_query'])) {
                        $sql = "SELECT *, CONCAT('Rp.',FORMAT(harga ,2,'de_DE')) AS Harga,  CONCAT('Rp.',FORMAT(harga * Jumlah * 0.95,2,'de_DE'))  AS total_harga FROM muhammad_1 where nama like '%$_GET[search_query]%'";
                    } else {
                        $sql = "SELECT *, CONCAT('Rp.',FORMAT(harga,2,'de_DE')) AS Harga, CONCAT('Rp.',FORMAT(harga * Jumlah * 0.95,2,'de_DE')) AS total_harga FROM muhammad_1";

                    }
                    try {
                        $result = $mysqli->query($sql);
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $row['id_pembeli']; ?></th>
                                <td><b><?php echo $row['nama']; ?></b></td>
                                <td><?php echo $row['Tgl_Transaksi']; ?></td>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td><?php echo $row['Jumlah']; ?></td>
                                <td><?php echo $row['Harga']; ?></td>
                                <td><?php echo $row['total_harga']; ?></td>

                                <td>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal<?php echo $row['id_pembeli']; ?>">
                                        Details
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $row['id_pembeli']; ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">ID<?php echo $row['id_pembeli']; ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Nama</th>
                                                                <td><?php echo $row['nama']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Alamat</th>
                                                                <td><?php echo $row['alamat']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">No Telp</th>
                                                                <td><?php echo $row['HP']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Tanggal Transaksi</th>
                                                                <td><?php echo $row['Tgl_Transaksi']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Jenis Barang</th>
                                                                <td><?php echo $row['Jenis_Barang']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Nama Barang</th>
                                                                <td><?php echo $row['nama_barang']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Jenis Barang</th>
                                                                <td><?php echo $row['Jumlah']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Harga Barang</th>
                                                                <td><?php echo $row['Harga']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Total Harga</th>
                                                                <td><?php echo $row['total_harga']; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="update.php?id=<?php echo $row['id_pembeli']; ?>">
                                        <input type="submit" class="btn btn-warning" value="Update" />
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['id_pembeli']; ?>">
                                        <input type="submit" class="btn btn-danger" value="Delete" />
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } catch (Exception $e) {
                        echo "data belum ada silahkan refresh";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="asset/snippet.js"></script>

</body>

</html>