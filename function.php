<?php
session_start();

//Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pbm");

//Tambah Mata Uang ke Database
if (isset($_POST['addnewcurrency'])){
    $matauang = $_POST['matauang'];
    $nilai = $_POST['nilaimatauang'];

    $addtotablekurs = mysqli_query($conn, "insert into kurs (mataUang, harga) values('$matauang', '$nilai')");
    if ($addtotablekurs){
        header('location:kurs.php');
    } else {
        echo "gagal";
        header('location:kurs.php');
    }
}

//Edit Mata Uang
if (isset($_POST['editcurrency'])){
    $nilaiedit = $_POST['nilaimatauangedit'];
    $pengenalkurs = $_POST['pengenalkurs'];

    $editdbkurs = mysqli_query($conn, "UPDATE kurs SET harga='$nilaiedit' WHERE mataUang='$pengenalkurs'");
    if ($editdbkurs){
        header('location:kurs.php');
    } else {
        echo "gagal";
        header('location:kurs.php');
    }
}


//Tambah Customer ke Database
if (isset($_POST['addcust'])){
    $namacust = $_POST['namacust'];
    $alamat = $_POST['alamatcust'];

    $addtotablecust = mysqli_query($conn, "insert into customer (namaCust, alamatCust) values('$namacust', '$alamat')");
    if ($addtotablecust){
        header('location:customer.php');
    } else {
        echo "gagal";
        header('location:customer.php');
    }
}

//Edit Customer
if (isset($_POST['editcust'])){
    $namacustedit = $_POST['namacustedit'];
    $alamatedit = $_POST['alamatedit'];
    $pengenalcust = $_POST['pengenalcust'];

    $editdbcust = mysqli_query($conn, "UPDATE customer SET namaCust='$namacustedit', alamatCust='$alamatedit' WHERE idCust='$pengenalcust'");
    if ($editdbcust){
        header('location:customer.php');
    } else {
        echo "gagal";
        header('location:customer.php');
    }
}

//Tambah Jenis Barang
if (isset($_POST['addjenisbarang'])){
    $barang = $_POST['namabarang'];

    $addtotablebrg = mysqli_query($conn, "insert into barang (namaBarang) values('$barang')");
    if ($addtotablebrg){
        header('location:barang.php');
    } else {
        echo "gagal";
        header('location:barang.php');
    }
}

//Tambah Stock Barang Gudang
if (isset($_POST['addbaranggd'])){
    $idbaranggd = $_POST['baranggd'];
    $jumlahbaranggd =  $_POST['jumlahbaranggd'];

    $rowdenganbarangsama = mysqli_query($conn, "select * from baranggudang where idBarang='$idbaranggd'");
    $jumlahrowdenganbarangsama = mysqli_num_rows($rowdenganbarangsama);

    if ($jumlahrowdenganbarangsama > 0){
        $ambildatasekarang = mysqli_fetch_array($rowdenganbarangsama);
        $jumlahsekarang = $ambildatasekarang['jumlah'];

        $jumlahafter = $jumlahsekarang + $jumlahbaranggd;

        $tambahbaranggdkedb = mysqli_query($conn, "update baranggudang set jumlah='$jumlahafter' where idBarang='$idbaranggd'");
        if ($tambahbaranggdkedb){
            header('location:index.php');
        } else {
            echo "gagal";
            header('location:index.php');
        }
    }
    else{
        $tambahbaranggdkedbbaru = mysqli_query($conn, "insert into baranggudang (idBarang, jumlah) values ('$idbaranggd', '$jumlahbaranggd')");
        if ($tambahbaranggdkedbbaru){
            header('location:index.php');
        } else {
            echo "gagal";
            header('location:index.php');
        }
    }
}

//Pindah Stock ke Konsinyasi
if (isset($_POST['addbarangkn'])){
    $idbarangkn = $_POST['barangkn'];
    $jumlahbarangkn =  $_POST['jumlahbarangkn'];
    $idcustkn = $_POST['custkn'];

    $rowdenganbarangsamakn = mysqli_query($conn, "select * from barangkonsinyasi where idBarang='$idbarangkn' AND idCust='$idcustkn'");
    $jumlahrowdenganbarangsamakn = mysqli_num_rows($rowdenganbarangsamakn);

    $datagudang = mysqli_query($conn, "select * from baranggudang where idBarang='$idbarangkn'");
    $arraydatagudang = mysqli_fetch_array($datagudang);
    $jumlahdatagudang = $arraydatagudang['jumlah'];

    if ($jumlahdatagudang >= $jumlahbarangkn){
        if ($jumlahrowdenganbarangsamakn > 0){
            $ambildatasekarangkn = mysqli_fetch_array($rowdenganbarangsamakn);
            $jumlahsekarangkn = $ambildatasekarangkn['jumlah'];

            $jumlahafterkn = $jumlahsekarangkn + $jumlahbarangkn;
            $datagudangafterkn = $jumlahdatagudang - $jumlahbarangkn;

            $tambahbarangknkedb = mysqli_query($conn, "update barangkonsinyasi set jumlah='$jumlahafterkn' where idBarang='$idbarangkn' AND idCust='$idcustkn'");
            $kurangibaranggudang = mysqli_query($conn, "update baranggudang set jumlah='$datagudangafterkn' where idBarang='$idbarangkn'");
            if ($tambahbarangknkedb && $kurangibaranggudang){
                header('location:konsinyasi.php');
            } else {
                echo "gagal";
                header('location:konsinyasi.php');
            }
        }
        else{
            $datagudangafterknbaru = $jumlahdatagudang - $jumlahbarangkn;

            $kurangibaranggudangbaru = mysqli_query($conn, "update baranggudang set jumlah='$datagudangafterknbaru' where idBarang='$idbarangkn'");
            $tambahbarangknkedbbaru = mysqli_query($conn, "insert into barangkonsinyasi (idBarang, jumlah, idCust) values ('$idbarangkn', '$jumlahbarangkn', '$idcustkn')");
            if ($tambahbarangknkedbbaru && $kurangibaranggudangbaru){
                header('location:konsinyasi.php');
            } else {
                echo "gagal";
                header('location:konsinyasi.php');
            }
        }
    }
    else{
        echo "gagal";
        header('location:konsinyasi.php');
    }
}

//Menambahkan harga barang
if (isset($_POST['addhrgbrg'])){
    $baranghrg = $_POST['hrgbarang'];
    $custhrg = $_POST['custhrg'];
    $harga = $_POST['hargabarang'];
    $kurshrg = $_POST['kurshrg'];

    //cari udh ada atau belom
    $barissama = mysqli_query($conn, "SELECT * FROM hargabarangcustomer WHERE idBarang='$baranghrg' AND idCust='$custhrg'");
    $banyakbarissama = mysqli_num_rows($barissama);

    if ($banyakbarissama == 0){
        $masukdbharga = mysqli_query($conn, "INSERT INTO hargabarangcustomer (idCust, idBarang, harga, mataUang) VALUES ('$custhrg','$baranghrg','$harga','$kurshrg')");
        if ($masukdbharga){
            header('location:hargabarang.php');
        }
        else{
            echo "gagal";
            header('location:hargabarang.php');
        }
    }
    else{
        echo "gagal";
        header('location:hargabarang.php');
    }
}

//Masukkan barang ke keranjang (invoice biasa)
if (isset($_POST['masukkeranjang'])){
    $idbarangkrj = $_POST['pengenalbrg'];
    $jumlahkrj = $_POST['jumlahtokeranjang'];
    $hargasatuan = $_POST['hargasatuan'];

    //cek apakah udh ada apa belom
    $datakrjsama = mysqli_query($conn, "SELECT * FROM keranjang WHERE idBarang='$idbarangkrj'");
    $jumlahdatakrjsama = mysqli_num_rows($datakrjsama);

    if ($jumlahdatakrjsama == 0){
        $barangbarumasuk = mysqli_query($conn, "INSERT INTO keranjang (idBarang, jumlah, hargaSatuan) VALUES ('$idbarangkrj', '$jumlahkrj', $hargasatuan)");
        if ($barangbarumasuk){
            header('location:invoice.php');
        }
        else{
            echo "gagal";
            header('location:invoice.php');
        }
    }
    else{
        $baranglamamasuk = mysqli_query($conn, "UPDATE keranjang SET jumlah='$jumlahkrj', hargaSatuan='$hargasatuan' WHERE idBarang='$idbarangkrj'");
        if ($baranglamamasuk){
            header('location:invoice.php');
        }
        else{
            echo "gagal";
            header('location:invoice.php');
        }
    }
}
//Edit Keranjang (Invoice biasa)
if (isset($_POST['editkeranjang'])){
    $jumlahbarukrj = $_POST['jumlahbarukeranjang'];
    $idkeranjang = $_POST['pengenalbrgkrjbaru'];
    $ubahjumlahkeranjang = mysqli_query($conn, "UPDATE keranjang SET jumlah='$jumlahbarukrj' WHERE idBarang='$idkeranjang'");
    if ($ubahjumlahkeranjang){
        header('location:invoice.php');
    }
    else{
        echo "gagal";
        header('location:invoice.php');
    }
}

// Kirim idCust ke Form untuk buat Invoice
if (isset($_POST['pilihCustInvoice'])){
    $_SESSION['idCustInvoice'] = $_POST['custUntukInvoice'];
    $hapusIsiKeranjang = mysqli_query($conn, "TRUNCATE TABLE keranjang");
    header('location:invoice.php');
}


?>