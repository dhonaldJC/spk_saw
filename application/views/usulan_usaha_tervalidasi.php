      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Usulan Usaha Tervalidasi </strong></h3>
            </div>
            </br>

            <?php foreach ($pengguna->result() as $user)?>
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><center>Nama Usaha</center></th>
                    <th><center>Nama Ketua Kelompok</center></th>
                    <th><center>Kategori Usaha</center></th>
                    <th><center>Fakultas</center></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      foreach($usulan_valid->result_array() as $data){
                        ?>
                        <tr>
                          <td><center><?php echo $data['nama_usaha'];?></center></td>
                          <td><center><?php echo $data['nama'];?></center></td>
                          <td><center><?php echo $data['nama_kategori_usaha'];?></center></td>
                          <td><center><?php echo $data['fakultas'];?></center></td>
                        </tr>
                <?php
                      }
                    ?>
                </tbody>
              </table>

            </div>
          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>