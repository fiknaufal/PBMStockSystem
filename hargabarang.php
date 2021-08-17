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
        <title>PBM - Harga Barang</title>
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
                        <h1 class="mt-4">Harga Barang</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Harga Barang
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Nama Customer</th>
                                                <th>Harga</th>
                                                <th>Mata Uang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $datahargabarang = mysqli_query($conn, "SELECT * FROM hargabarangcustomer as hb, barang as b, customer as c WHERE b.idBarang = hb.idBarang AND hb.idCust = c.idCust");
                                        while ($dataharga = mysqli_fetch_array($datahargabarang)){
                                            $harga = $dataharga['harga'];
                                            $namabrghrg = $dataharga['namaBarang'];
                                            $namacusthrg = $dataharga['namaCust'];
                                            $matauanghrg = $dataharga['mataUang'];
                                        ?>
                                            <tr>
                                                <td><?=$namabrghrg;?></td>
                                                <td><?=$namacusthrg;?></td>
                                                <td><?=$harga;?></td>
                                                <td><?=$matauanghrg;?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
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

            <!-- The Modal -->
            <div class="modal fade" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Tambah Harga Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        <select name="hrgbarang" class="form-control">
                            <?php
                                $datanamabaranghrg = mysqli_query($conn, "SELECT * FROM barang");
                                while ($fetcharrayhrg = mysqli_fetch_array($datanamabaranghrg)){
                                    $namabarangpilihanhrg = $fetcharrayhrg['namaBarang'];
                                    $idbarangpilihanhrg = $fetcharrayhrg['idBarang'];
                            ?>

                            <option value="<?=$idbarangpilihanhrg;?>"><?=$namabarangpilihanhrg;?></option>

                            <?php
                                }
                            ?>

                        </select>
                        <br>
                        <select name="custhrg" class="form-control">
                            <?php
                                $datanamacusthrg = mysqli_query($conn, "SELECT * FROM customer");
                                while ($fetcharraycusthrg = mysqli_fetch_array($datanamacusthrg)){
                                    $namacusthrg = $fetcharraycusthrg['namaCust'];
                                    $idcusthrg = $fetcharraycusthrg['idCust'];
                            ?>

                            <option value="<?=$idcusthrg;?>"><?=$namacusthrg;?></option>

                            <?php
                                }
                            ?>

                        </select>
                        <br>
                        <input type="number" step="any" name="hargabarang" placeholder="Harga" class="form-control" required>
                        <br>
                        <select name="kurshrg" class="form-control">
                            <?php
                                $datakurshrg = mysqli_query($conn, "SELECT * FROM kurs");
                                while ($fetcharraykurshrg = mysqli_fetch_array($datakurshrg)){
                                    $namakurshrg = $fetcharraykurshrg['mataUang'];
                            ?>

                            <option value="<?=$namakurshrg;?>"><?=$namakurshrg;?></option>

                            <?php
                                }
                            ?>

                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary" name="addhrgbrg">Submit</button>
                    </div>
                </form>
                
            </div>
            </div>
        </div>
</html>
