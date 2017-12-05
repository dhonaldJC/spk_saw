      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Document Upload Usulan Usaha</strong></h3>
            </div>
            </br>

            <?php foreach ($pengguna->result() as $user)?>
            <div class="box-body">

              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><center>Nama Usaha</center></th>
                    <th><center>File Proposal</center></th>
                    <th><center>File Cashflow</center></th>
                    <th><center>File KPM</center></th>
                    <th><center>File CV</center></th>
                    <th><center>File Pelatihan</center></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      foreach($all_usulan->result_array() as $data){?>
                        <tr>
                          <td><center><?php echo $data['nama_usaha'];?></center></td>
                          <td><a href="<?php echo base_url('uploads/proposal_usulan');?>/<?php echo $data['userfile']?>"><i class="fa fa-download"></i> <?php echo $data['userfile']?></a></td>
                      <?php }?>
                      <?php
                        foreach($cashflow->result_array() as $data){?>
                          <td><a href="<?php echo base_url('uploads/cashflow');?>/<?php echo $data['file_cashflow']?>"><i class="fa fa-download"></i> <?php echo $data['file_cashflow']?></a></td>
                        <?php } ?>
                      <?php
                        foreach($kpm->result_array() as $data){?>
                          <td><a href="<?php echo base_url('uploads/kpm');?>/<?php echo $data['file_kpm']?>"><i class="fa fa-download"></i> <?php echo $data['file_kpm']?></a></td>
                        <?php } ?>
                      <?php
                        foreach($cv->result_array() as $data){?>
                          <td><a href="<?php echo base_url('uploads/curiculum_vitae');?>/<?php echo $data['file_cv']?>"><i class="fa fa-download"></i> <?php echo $data['file_cv']?></a></td>
                        <?php } ?>
                      <?php
                        foreach($pelatihan->result_array() as $data){?>
                          <td><a href="<?php echo base_url('uploads/pernyataan_pelatihan');?>/<?php echo $data['file_pelatihan']?>"><i class="fa fa-download"></i> <?php echo $data['file_pelatihan']?></a></td>
                        <?php } ?>
                        </tr>
                </tbody>
              </table>

            </div>
          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>