      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">List Usulan Usaha Lolos <strong>TAHAP PERTAMA</strong></h3>
            </div>
            </br>
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><center>Nama Usaha</center></th>
                    <th><center>Nama Ketua Kelompok</center></th>
                    <th><center>Kategori Usaha</center></th>
                    <th><center>File Proposal</center></th>
                    <th><center>File Cashflow</center></th>
                    <th><center>File CV</center></th>
                    <th><center>Aksi</center></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      foreach($tahap_akhir->result_array() as $data){
                        ?>
                        <tr>
                          <td><center><?php echo $data['nama_usaha'];?></center></td>
                          <td><center><?php echo $data['nama'];?></center></td>
                          <td><center><?php echo $data['nama_kategori_usaha'];?></center></td>

                          <?php
                          foreach ($all_usulan->result_array() as $all) {
                            if ($all['nama_usaha'] == $data['nama_usaha']) {?>
                            <td><a href="<?php echo base_url('uploads/proposal_usulan');?>/<?php echo $all['userfile']?>"><i class="fa fa-download"></i> <?php echo $all['userfile']?></a></td>
                          <?php
                            }
                          }
                           ?>

                          <?php
                          foreach ($all_usulan->result_array() as $all) {
                            if ($all['nama_usaha'] == $data['nama_usaha']) {?>
                            <td><a href="<?php echo base_url('uploads/proposal_usulan');?>/<?php echo $all['userfile']?>"><i class="fa fa-download"></i> <?php echo $all['userfile']?></a></td>
                          <?php
                            }
                          }
                           ?>

                          <?php
                          foreach ($all_usulan->result_array() as $all) {
                            if ($all['nama_usaha'] == $data['nama_usaha']) {?>
                            <td><a href="<?php echo base_url('uploads/proposal_usulan');?>/<?php echo $all['userfile']?>"><i class="fa fa-download"></i> <?php echo $all['userfile']?></a></td>
                          <?php
                            }
                          }
                           ?>

                          <td width="100px"><center>
                            <a href="<?php echo base_url('web/form_penilaian_tahapakhir');?>/<?php echo $data['kode_usulan'];?>"><button class="btn btn-info btn-sm">Beri Nilai</button></a>
                            </center>
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
