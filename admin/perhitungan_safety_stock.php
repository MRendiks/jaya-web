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
          <h1 class="h3 mb-2 text-gray-800">Perhitungan Safety Stock</h1>
          <p class="mb-4">Gantari Elektrik</p>
          <?php

          # MENENTUKAN LEAD TIME

          $waktu_pengiriman = [6, 4, 3, 8, 7, 4, 6, 5, 3, 6, 7, 5, 3, 4, 5, 5, 3, 3, 3, 5, 7, 7, 7, 4, 5, 8, 7, 3, 5, 6, 3, 8, 4, 7, 7, 3, 6, 4, 8, 6, 5, 8, 7, 4, 4, 8, 3, 3, 5, 4, 5, 7, 7, 7, 5, 7, 4, 3, 8, 4, 4, 6, 6, 7, 6, 4, 5, 7, 5, 5];

          $lead_time = 5;

          $jumlah_nilai_varian = 0;

          for ($i=0; $i < count($waktu_pengiriman) ; $i++) { 
            $jumlah_nilai_varian += ($waktu_pengiriman[$i] -  $lead_time);
          }

          #==================================================================================================

          # MENENTUKAN STANDAR DEVIASI

          $rata_rata_waktu_penyetokan = $jumlah_nilai_varian / $lead_time;

          $nilai_standar_deviasi = $rata_rata_waktu_penyetokan + $lead_time;

          #==================================================================================================

          # MENENTUKAN PERMINTAAN RATA-RATA

          $permintaan_rata_rata = [];

          $tingkat_layanan = 1.25;

          $hasil_akhir_safety_stock = [];

          $data_quantity = [];

          $data_nama = [];

          $query="SELECT nama,quantity FROM barang";

          $result=mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

          $i = 0;

          while($data=mysqli_fetch_array($result))
          {
            array_push($data_nama, $data['nama']);

            array_push($data_quantity, $data['quantity']);

            array_push($permintaan_rata_rata, ($data['quantity'] / 26));

            array_push($hasil_akhir_safety_stock, ($tingkat_layanan * $nilai_standar_deviasi * $permintaan_rata_rata[$i] ));

            $i++;
          }

          ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Perhitungan</h6>
            </div>
            <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="custom-nav-a-tab" data-toggle="tab" href="#custom-nav-a" role="tab" aria-controls="custom-nav-a" aria-selected="true">Perhitungan</a>
                    <a class="nav-item nav-link" id="custom-nav-b-tab" data-toggle="tab" href="#custom-nav-b" role="tab" aria-controls="custom-nav-b" aria-selected="false">Safety Stock</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
              <div class="tab-pane fade show active" id="custom-nav-a" role="tabpanel" aria-labelledby="custom-nav-a-tab">
              <div class="card-body">
                <table style="margin-top: 20px;" id="example" class="table table-hover table-bordered">
                  <tr>
                    <th>No</th>
                    <th>Proses</th>
                    <th>Perhitungan</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Menentukan Lead Time</td>
                    <td>
                      <?php 
                      $wp = implode(", ", $waktu_pengiriman);
                      echo "Waktu Pengiriman = [$wp]";
                      echo "<br><br>";
                      echo "Lead Time = $lead_time";
                      echo "<br><br>";

                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Menentukan Standar Deviasi</td>
                    <td>
                      <?php 
                      echo "Jumlah Nilai Varian = ";
                      for ($i=0; $i < count($waktu_pengiriman); $i++) { 
                          echo " ($waktu_pengiriman[$i] - $lead_time) + ";
                      }
                      echo " = $jumlah_nilai_varian";
                      echo "<br><br>";
                      echo "Rata-Rata Waktu Penyetokan = $jumlah_nilai_varian / $lead_time = $rata_rata_waktu_penyetokan";
                      echo "<br><br>";
                      echo "Nilai Standar Deviasi = $rata_rata_waktu_penyetokan + $lead_time = $nilai_standar_deviasi";
                      echo "<br><br>";
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Menentukan Permintaan Rata-Rata</td>
                    <td>
                      <?php 
                      echo "Permintaan Rata-Rata = ";
                      for ($i=0; $i < count($data_quantity); $i++) { 
                          echo "$data_nama[$i]  - ($data_quantity[$i] / 26 Hari) = " .  number_format((float)($data_quantity [$i] / 26), 2, '.', '') ;
                          echo "<br><br>";
                      }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Menentukan Tingkat Layanan</td>
                    <td>
                      <?php 
                      echo "Tingkat Layanan = $tingkat_layanan ";
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Menghitung Safety Stock</td>
                    <td>
                      <?php 
                      echo "Safety Stock = " ;
                      for ($i=0; $i < count($data_quantity); $i++) { 
                        echo "Safety Stock  - $data_nama[$i] = " .  "($tingkat_layanan x $nilai_standar_deviasi x " .  number_format((float)$permintaan_rata_rata[$i], 2, '.', '') . ")".  " = " . number_format((float)$hasil_akhir_safety_stock[$i], 2, '.', '');
                        echo "<br><br>";
                      }
                      " ";
                      ?>
                    </td>
                  </tr>
                </table>
              </div>
              </div>

              <div class="tab-pane fade" id="custom-nav-b" role="tabpanel" aria-labelledby="custom-nav-b-tab">
              <div class="card-body">
                <table style="margin-top: 20px;" id="example" class="table table-hover table-bordered">
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Safety Stock</th>
                  </tr>
                  <?php
                    $query2="SELECT * FROM barang";
                    
                    $result=mysqli_query($koneksi, $query2) or die(mysqli_error($koneksi));
                  ?>

                    <?php 
                       $no=0;
                       $i =0;
                       while($data=mysqli_fetch_array($result))
                      { $no++;
                       ?>
                      <tbody>
                      <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data['nama']; ?></td>
                      <td><?php echo $data['kategori']; ?></td>
                      <td><?php echo $data['quantity']; ?></td>
                      <td><?php echo $data['price']; ?></td>
                      <td><?php 
                      echo number_format((float)$hasil_akhir_safety_stock[$i], 2, '.', '');
                      $i++;
                      ?></td>
                      </tr>

                      <?php } ?>
                  
                </table>
              </div>
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
