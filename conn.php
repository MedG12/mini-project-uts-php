<?php
$host = "localhost";
$usernme = "root";
$password = "";
$mysqli = new mysqli($host, $usernme, $password);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//create database jika belum ada database
try {
    $mysqli->select_db("muhammad");
} catch (Exception $e) {
    $mysqli->query(
        "
        CREATE DATABASE muhammad;
        "
    );

    $mysqli->select_db("muhammad");
    //create table muhammad_1
    $mysqli->query(
        "
            CREATE TABLE muhammad_1 (
            id_pembeli int(10) NOT NULL AUTO_INCREMENT,
            nama varchar(30) NOT NULL,
            alamat varchar(50) NOT NULL,
            HP varchar(20) NOT NULL,
            Tgl_Transaksi date NOT NULL,
            Jenis_Barang varchar(25) NOT NULL,
            nama_barang varchar(50) NOT NULL,
            Jumlah int(20) NOT NULL,
            Harga int(25) NOT NULL,
            PRIMARY KEY (id_pembeli)
        );
        "
    );
    $query = " ";

    $data = file_get_contents("asset/data.json");
    $array = json_decode($data, true);
    foreach ($array as $row) {
        $query .= "INSERT INTO muhammad_1 
    (
        nama,
        alamat,
        HP,
        Tgl_Transaksi,
        Jenis_Barang,
        nama_barang,
        Jumlah,
        Harga
    )
    VALUES(
        '$row[nama]',
        '$row[alamat]',
        '$row[HP]',
        '$row[Tgl_Transaksi]',
        '$row[Jenis_Barang]',
        '$row[nama_barang]',
        '$row[Jumlah]',
        '$row[Harga]' 
    );
    ";

    }
    $mysqli->multi_query($query);
}


