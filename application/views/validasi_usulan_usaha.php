      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Validasi Usulan Usaha</strong></h3>
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

                    <th><center>Aksi</center></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      foreach($adata_usulan->result_array() as $data){
                        ?>
                        <tr>
                          <td><center><?php echo $data['nama_usaha'];?></center></td>
                          <td><center><?php echo $data['nama'];?></center></td>
                          <td><center><?php echo $data['nama_kategori_usaha'];?></center></td>
                          <td><center><?php echo $data['fakultas'];?></center></td>
                          <td>
                          <a onClick="return confirmSubmit()" href="<?php echo base_url('Web/validasi_usulan');?>/<?php echo $data['kode_usulan'];?>/<?php echo $data['nim_ketua'];?>">
                              <button class="btn btn-success btn-xs">
                                <i class="fa fa-check">VALIDASI</i>
                              </button>
                            </a>
                        </td>
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
