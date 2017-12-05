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
                  </tr>
                </thead>
                <tbody>
                    <?php
                      foreach($all_usulan->result_array() as $data){
                        if ($data['fakultas'] == $user->fakultas) {
                        ?>
                        <tr>
                          <td><center><?php echo $data['nama_usaha'];?></center></td>
                          <td><a href="<?php echo base_url('uploads/proposal_usulan');?>/<?php echo $data['userfile']?>"><i class="fa fa-download"></i> <?php echo $data['userfile']?></a></td>
                      <?php } }?>
                      <?php
                        foreach($cashflow->result_array() as $data){?>
                          <td><a href="<?php echo base_url('uploads/cashflow');?>/<?php echo $data['file_cashflow']?>"><i class="fa fa-download"></i> <?php echo $data['file_cashflow']?></a></td>
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