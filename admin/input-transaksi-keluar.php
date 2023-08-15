<?php include "session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
   <?php include "menu.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include "navbar.php"; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Transaksi Keluar</h1>
          <p class="mb-4">Gantari Elektrik</p>
          <?php
if(isset($_POST['simpan'])){

$tanggal         = $_POST['date'];
$id              = $_POST['id'];
$nama            = $_POST['nama'];
$quantity        = $_POST['quantity'];
$price           = $_POST['price'];
$stats           = "OUT";
$entry           = $_SESSION['fullname'];

                    $insert = mysqli_query($koneksi, "INSERT INTO transaksi (tanggal, id, nama, quantity, price, stats, entry)
                     VALUES('$tanggal', '$id', '$nama', '$quantity', '$price', '$stats', '$entry' )") or die(mysqli_error($koneksi));

                    $qu = mysqli_query($koneksi, "UPDATE barang SET quantity=(quantity-'$quantity') WHERE id='$id'");
                     if($insert&&$qu){
                          //$querack = mysqli_query($koneksi, "UPDATE rack SET status='$terisi' WHERE rack_no='$rack_no'");

                          //$insert_history = mysqli_query($koneksi, "INSERT INTO histori_transaksi(id, tanggal, id_pallet, rack_no, part_no, qty, unit, status, pic)
                          //VALUES('$id', '$date', '$id_pallet', '$rack_no', '$part_no', '$qty', '$unit', '$status', '$_SESSION[fullname]')") or die(mysqli_error($koneksi));
                          //echo "<script>window.location = 'index.php'</script>";  
                          echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
				       }else{
					      echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
                       }
}

                ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Input Transaksi Barang Keluar</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <form class="form-horizontal style-form" action="input-transaksi-keluar.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
                              <div class="col-sm-3">
                                  <input name="date" type="date" id="date" class="form-control" value="<?php $d = date("Y-m-d"); echo $d; ?>" placeholder="Date" autocomplete="off" required/>
                              </div>
                          </div>
                          
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kode Barang<br><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><b>Cari</b> <span class="glyphicon glyphicon-search"></span></button>
                              </label>
                              <div class="col-sm-3">
                              <input name="id" type="text" id="id" class="form-control" placeholder="Kode Barang" autocomplete="off"  />
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Barang</label>
                              <div class="col-sm-6">
                                  <input name="nama" type="text" id="nama" class="form-control" placeholder="Nama Barang" autocomplete="off" required="required" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">QTY</label>
                              <div class="col-sm-2">
                                  <input name="quantity" type="number" id="quantity" class="form-control" placeholder="quantity" autocomplete="off" required="required" />
                              </div>
                          </div>
                          
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Harga</label>
                              <div class="col-sm-2">
                                  <input name="price" type="text" id="price" class="form-control" placeholder="harga" autocomplete="off" required="required"  />
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" name="simpan" value="Simpan" class="btn btn-lg btn-primary" />&nbsp;
	                              <a href="index.php" class="btn btn-lg btn-danger">Batal </a>
                              </div>
                          </div>
                      </form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
  <?php include "footer.php"; ?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:600px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Master Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>nama</th>
									<th>Qty</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Data mentah yang ditampilkan ke tabel    
                               
                                $query = mysqli_query($koneksi, 'SELECT * FROM barang');
                                while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr class="pilih" data-part="<?php echo $data['id'];  ?>" data-name="<?php echo $data['nama'];  ?>" data-satuan="<?php echo $data['price'];  ?>">
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['quantity']; ?></td>
										<td><?php echo $data['price']; ?></td>
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
        <script type="text/javascript">

//            jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
                document.getElementById("id").value = $(this).attr('data-part');
                document.getElementById("nama").value = $(this).attr('data-name');
                document.getElementById("price").value = $(this).attr('data-satuan');
                $('#myModal').modal('hide');
            });
			

//            tabel lookup mahasiswa
            $(function () {
                $("#lookup").dataTable();
            });

            function dummy() {
                var nim = document.getElementById("nim").value;
                alert('Nomor Induk Mahasiswa ' + nim + ' berhasil tersimpan');
				
				var ket = document.getElementById("ket").value;
                alert('Keterangan ' + ket + ' berhasil tersimpan');
            }
        </script>
</body>

</html>
