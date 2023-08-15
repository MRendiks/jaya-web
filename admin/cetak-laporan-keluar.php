<!DOCTYPE html>
<html>
    <head>
        <title>Cetak Semua Data laporan Penjualan</title>
        <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>  
    <body onload="print()">
        <!--Menampilkan data detail arsip-->
        <?php
        include 'session.php';
        ?>   

        <div class="container">
            <div class='row'>
                <div class="col-sm-12">
                    <!--dalam tabel--->
                    <div class>
                    <h2>
                            <center> GANTARI ELEKTRIK </center></h2>
                        <h4><center>Jl. Wahid Hasyim, Dabag, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta. </center></h4>
                        <hr>
                        <h3><center>LAPORAN DATA TRANSAKSI</center></h3>
                        <table class="table table-bordered table-striped table-hover"> 
                        <tbody>
                        <tr>
                        <th width="2%">No</th>
                        <th width="5%" >Tanggal</th>
                        <th width="5%" >Kode Barang</th>
                        <th width="5%" >Nama Barang</th>
                        <th width="5%" >Qty</th>
                        <th width="5%" >Harga</th>
                        <th width="5%" >Status</th>


                      </tr>
                            </tr>
                        </thead>
                        <tbody>
                            <!--ambil data dari database, dan tampilkan kedalam tabel-->
                            <?php
                            //buat sql untuk tampilan data, gunakan kata kunci select
                            $sql = "SELECT * FROM transaksi ";
                            $query = mysqli_query($koneksi, $sql) or die("SQL Anda Salah");
                            //Baca hasil query dari databse, gunakan perulangan untuk
                            //Menampilkan data lebh dari satu. disini akan digunakan
                            //while dan fungdi mysqli_fecth_array
                            //Membuat variabel untuk menampilkan nomor urut
                            $nomor = 0;
                            //Melakukan perulangan u/menampilkan data
                            while ($data1 = mysqli_fetch_array($query)) {
                                $nomor++; //Penambahan satu untuk nilai var nomor
                                ?>
                                    <tr>
                                    <td><?= $nomor ?></td>
                                    <td><?= $data1['tanggal'] ?></td>
                                    <td><?= $data1['id'] ?></td>
                                    <td><?= $data1['nama'] ?></td>
                                    <td><?= $data1['quantity'] ?></td>
                                    <td><?= $data1['price'] ?></td>
                                    <td><?= $data1['stats'] ?></td>



                                </tr>
                                <!--Tutup Perulangan data-->
                            <?php } ?>
							</tbody>
                        </tbody>
                        <tfoot> 
                                <tr>
                                <td colspan="10" class="text-right">
                                        Yogyakarta  <?= date("d-m-Y") ?>
                                        <br><br><br><br>
                                        <u>Gantari Elektrik<strong></u><br>
                                        
									</td>
								</tr>
							</tfoot> 
                        </table>
                    </div>
                </div>
            </div>
    </body>
</html>