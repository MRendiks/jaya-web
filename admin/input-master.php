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
          <h1 class="h3 mb-2 text-gray-800">Master Data</h1>
          <p class="mb-4">Gantari Elektrik</p>
          <?php
        if(isset($_POST['simpan'])){
        $id             = $_POST['id'];
        $tanggal        = $_POST['date'];
        $nama           = $_POST['nama'];
        $kategori       = $_POST['kategori'];
        $quantity       = $_POST['quantity'];
        $price          = $_POST['price'];
        $stats      = "IN";

        $query = mysqli_query($koneksi, "INSERT INTO barang (id, tanggal, nama, kategori, quantity, price, stats) VALUES ('$id', '$tanggal', '$nama', '$kategori', '$quantity', '$price', '$stats')");
        if ($query){
	                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
			}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
				}
            }
                ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Data Brang</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <form class="form-horizontal style-form" action="input-master.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kode Barang</label>
                              <div class="col-sm-6">
                                  <input name="id" type="text" id="id" class="form-control" placeholder="Kode Barang" autofocus="on" required />
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
                              <div class="col-sm-3">
                                  <input name="date" type="date" id="date" class="form-control" value="<?php $d = date("Y-m-d"); echo $d; ?>" placeholder="Date" autocomplete="off" required/>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Barang</label>
                              <div class="col-sm-6">
                                  <input name="nama" type="text" id="nama" class="form-control" placeholder="Nama Barang" autocomplete="off" required />
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kategori</label>
                              <div class="col-sm-6">
                              <select name="kategori" id="kategori" class="form-control" required>
                              <option value="">- Pilih -</option>
                              <option value="kabel">kabel</option>
                              <option value="lampu">lampu</option>
                              <option value="kipas angin">kipas angin</option>
                              <option value="televisi">Televisi</option>
                              <option value="stop kontak">Stop Kontak</option>
                              <option value="antena">antena</option>
                              <option value="speaker">speaker</option>
                              <option value="Rice Cooker">Rice Cooker</option>
                              </select>
                            </div>

                          <div class="form-group">
                              <label class="col-sm-4 col-sm-4 control-label">Quantity</label>
                              <div class="col-sm-6">
                                  <input name="quantity" type="number" id="quantity" class="form-control" placeholder="Quantity" autocomplete="off"  />
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Harga</label>
                              <div class="col-sm-6">
                                  <input name="price" type="text" id="price" class="form-control" placeholder="harga" autocomplete="off"  />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="input-master.php" class="btn btn-sm btn-danger">Batal </a>
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
						url :"ajax-data-rack.php", // json datasource
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
