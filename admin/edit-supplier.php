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
          <h1 class="h3 mb-2 text-gray-800">Supplier</h1>
          <p class="mb-4">PT.BHJ<sup>App</sup>bumenhutamajaya.com</p>
          <?php
            $kd = $_GET['id_supplier'];
			$sql = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier='$kd'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: supplier.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['update'])){
			  	      $id                 = $_POST['id_supplier'];
                $namainstansi       = $_POST['nama_instansi'];
                $tanggalpengiriman  = sha1($_POST['tanggal_pengiriman']);
                $totalpembayaran    = $_POST['total_pembayaran'];

				
				$update = mysqli_query($koneksi, "UPDATE supplier SET nama_instansi='$namainstansi', tanggal_pengiriman='$tanggalpengiriman', total_pembayaran='$totalpembayaran' WHERE id_instansi='$id'") or die(mysqli_error());
				if($update){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
				}
			}
			
			//if(isset($_GET['pesan']) == 'sukses'){
			//	echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
			//}
			?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Data supplier</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <form class="form-horizontal style-form" action="tambah-supplier.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Id</label>
                              <div class="col-sm-6">
                                  <input name="id_supplier" type="text" id="id_supplier" class="form-control" value="<?php echo $row['id_supplier']; ?>" placeholder="Tidak perlu di isi" autofocus="on" readonly="readonly" />
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama_instansi</label>
                              <div class="col-sm-6">
                                  <input name="nama_instansi" type="text" id="nama_instansi" class="form-control" value="<?php echo $row['nama_instansi']; ?>" placeholder="nama_instansi" autocomplete="off" required />
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">tanggal_pengiriman</label>
                              <div class="col-sm-6">
                                  <input name="tanggal_pengiriman" type="text" id="tanggal_pengiriman" class="form-control" value="<?php echo $row['tanggal_pengiriman']; ?>" placeholder="tanggal_pengiriman" autocomplete="off" readonly="readonly" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">total_pembayaran</label>
                              <div class="col-sm-6">
                                  <input name="total_pembayaran" type="text" id="total_pembayaran" class="form-control" value="<?php echo $row['total_pembayaran']; ?>" placeholder="total_pembayaran" autocomplete="off" required />
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="tambah-supplier.php" class="btn btn-sm btn-danger">Batal </a>
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

  <script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"ajax-data-user.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".lookup-error").html("");
							$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#lookup_processing").css("display","none");
							
						}
					}
				} );
			} );
        </script>
</body>

</html>