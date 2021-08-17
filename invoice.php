<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PBM - Buat Invoice</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">PBM Stock System</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->

        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Gudang
                            </a>
                            <a class="nav-link" href="konsinyasi.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Konsinyasi
                            </a>
                            <a class="nav-link" href="daftarpo.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Daftar PO
                            </a>               
                            <a class="nav-link" href="barang.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Jenis Barang
                            </a>
                            <a class="nav-link" href="hargabarang.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Harga Barang
                            </a>                            
                            <a class="nav-link" href="penjualan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Penjualan
                            </a>                            
                            <a class="nav-link" href="customer.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Customer
                            </a>                            
                            <a class="nav-link" href="kurs.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kurs
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Buat Invoice</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                Pilihan Barang Gudang
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $idCustDipilih = $_SESSION['idCustInvoice'];
                                        $databaranggd = mysqli_query($conn, "SELECT * FROM barang as b, baranggudang as bg, hargabarangcustomer as hbc, kurs as k WHERE hbc.mataUang=k.mataUang AND b.idBarang = bg.idBarang AND hbc.idBarang = b.idBarang AND hbc.idCust = '$idCustDipilih' AND jumlah>0");
                                        while ($datagd = mysqli_fetch_array($databaranggd)){
                                            $jumlahgd = $datagd['jumlah'];
                                            $namabrggd = $datagd['namaBarang'];
                                            $idbrg = $datagd['idBarang'];
                                            $hrgbrg = $datagd[6];
                                            $hrgkurs = $datagd[9];
                                            $hrgsatuan = $hrgbrg * $hrgkurs;
                                        ?>
                                            <tr>
                                                <td><?=$namabrggd;?></td>
                                                <td><?=$jumlahgd;?></td>
                                                <td>Rp<?=$hrgsatuan;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahkan<?=$idbrg;?>">
                                                        Tambahkan
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Untuk Edit -->
                                            <div class="modal fade" id="modalTambahkan<?=$idbrg;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Jumlah yang Ditambahkan</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="number" name="jumlahtokeranjang"  placeholder="Jumlah" class="form-control" min="1" max="<?=$jumlahgd;?>" required>
                                                            <br>
                                                            <input type="hidden" name="pengenalbrg" value="<?=$idbrg;?>">
                                                            <input type="hidden" name="hargasatuan" value="<?=$hrgsatuan;?>">
                                                            <button type="submit" class="btn btn-primary" name="masukkeranjang">Tambahkan</button>
                                                        </div>
                                                    </form>
                                                    
                                                </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                Keranjang
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Harga Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $databaranggd = mysqli_query($conn, "SELECT * FROM barang as b, keranjang as kr, baranggudang as bg WHERE b.idBarang = kr.idBarang AND bg.idBarang = kr.idBarang");
                                        while ($datagd = mysqli_fetch_array($databaranggd)){
                                            $jumlahgd = $datagd[3];
                                            $namabrggd = $datagd['namaBarang'];
                                            $idbrg = $datagd['idBarang'];
                                            $hargasatuan = $datagd['hargaSatuan'];
                                            $hargajumlah = $hargasatuan * $jumlahgd;
                                            $jumlahdigudang = $datagd[6];
                                        ?>
                                            <tr>
                                                <td><?=$namabrggd;?></td>
                                                <td><?=$jumlahgd;?></td>
                                                <td>Rp<?=$hargasatuan;?></td>
                                                <td>Rp<?=$hargajumlah;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditKr<?=$idbrg;?>">
                                                        Edit
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Untuk Edit -->
                                            <div class="modal fade" id="modalEditKr<?=$idbrg;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Ubah Jumlah Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="number" name="jumlahbarukeranjang" value="<?=$jumlahgd;?>" placeholder="Jumlah" class="form-control" min="1" max="<?=$jumlahdigudang;?>" required>
                                                            <br>
                                                            <input type="hidden" name="pengenalbrgkrjbaru" value="<?=$idbrg;?>">
                                                            <button type="submit" class="btn btn-primary" name="editkeranjang">Ubah</button>
                                                        </div>
                                                    </form>
                                                    
                                                </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                        <?php
                                            $subtotal = 0;
                                            $datakrj = mysqli_query($conn, "SELECT * FROM keranjang");
                                            while ($datasatukrj = mysqli_fetch_array($datakrj)){
                                                $subtotal = $subtotal + ($datasatukrj['hargaSatuan'] * $datasatukrj['jumlah']);
                                            }
                                            $pajak = floor($subtotal / 10);
                                            $total = $subtotal + $pajak;
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><b>Subtotal</b></td>
                                                <td>Rp<?=$subtotal;?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><b>Pajak</b></td>
                                                <td>Rp<?=$pajak;?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><b>Total</b></td>
                                                <td>Rp<?=$total;?></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
