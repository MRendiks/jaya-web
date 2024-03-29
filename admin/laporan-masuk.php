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
          <h1 class="h3 mb-2 text-gray-800">LAPORAN TRANSAKSI</h1>
          <p class="mb-4">Gantari Elektrik</p>
          
          <?php
             if(isset($_GET['aksi']) == 'delete'){
				$id = $_GET['id'];
				$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
				}else{
					$delete = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");
					if($delete){
						echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
					}
				}
			}
			?>
<br/><br/>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data History Transaksi</h6>
            </div>
            <div class="card-body">
            <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <h6 class="m-0 font-weight-bold text-primary">History Barang Masuk</h6>
          </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="custom-nav-a" role="tabpanel" aria-labelledby="custom-nav-a-tab">
            <div class="card-body">
              
                <?php
                   
                 $tgl=date("Y-m-d");
	               $query2="SELECT * FROM barang 
	               where stats='IN' AND Tanggal='$tgl'";
                   
                    $tampil1=mysqli_query($koneksi, $query2) or die(mysqli_error($koneksi));
                    ?>
                  <table style="margin-top: 20px;" id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                      <th>No</th>
                          <th>Tanggal</th>
                          <th>Kode Barang</th>
                          <th>Nama Barang</th>
                          <th>Qty</th>
                          <th>Harga</th>
                          <th>Status</th>

                      </tr>
                  </thead>
                     <?php 
                     $no=0;
                     while($data1=mysqli_fetch_array($tampil1))
                    { $no++;
                     ?>
                    <tbody>
                    <tr>
                    <td><?php echo $no; ?></td>
                      <td><?php echo $data1['tanggal']; ?></td>
                      <td><?php echo $data1['id']; ?></td>
                      <td><?php echo $data1['nama']; ?></td>
                      <td><?php echo $data1['quantity']; ?></td>
                      <td><?php echo $data1['price']; ?></td>
                      <td><?php echo $data1['stats']; ?></td>


                    </tr>
                       
            <?php   
                }
               
                ?>    
                     </tbody>
                     </table>
                                        </div>
                                        <tr>
                                <td colspan="9">
                                    <a href="cetak-laporan-masuk.php" target="_blank" class="btn btn-info btn-sm">
                                        <span class="fa fa_print"></span> Cetak Semua Laporan
                                    </a>
                                    
                                </td>
                            </tr>                     
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
        
</div>

</body>

</html>
