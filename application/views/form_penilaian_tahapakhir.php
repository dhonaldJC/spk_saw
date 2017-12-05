      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Penilaian Usulan Usaha <strong>Tahap Akhir [TAHAP 2]</strong></h3>
            </div>
            </br>
            <div class="box-body">
              <form action="<?php echo base_url();?>web/getpenilaian_WP" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                  
                  <?php foreach($na_usulan->result_array() as $data){?>
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Usaha</label>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                      <input type="text" name="kode_usulan" value="<?php echo $data['kode_usulan']; ?>" hidden>
                      <input type="text" name="nama_usaha" value="<?php echo $data['nama_usaha']; ?>" class="form-control" placeholder="Masukkan Nama Usaha">
                    <?php echo form_error('nama_usaha'); }?>
                    </div>
                  </div>

                  <div class="form-group col-lg-10">
                  </div>
                  <div class="form-group col-lg-10">
                  </div>


                  <?php  foreach($label->result() as $row){ ?>
                  <div class="form-group col-lg-12">
                    <label class="control-label col-md-5 col-sm-3 col-xs-12"><?php echo 'Apakah usaha ini mempunyai '.$row->subkriteria.' ?'; ?></label>
                    <div class="col-md-12 col-sm-6 col-xs-12">
                      <?php  
                        foreach($subkategori->result() as $row2){
                          if ($row2->kode_subkriteria_WP == $row->kode_subkriteria_WP && $row2->type=="radio") {?>
                            <div class="input-group">
                                  <span class="input-group-addon">
                                    <input type="radio" name="subkategori<?php echo $row2->id_nilaibobot_WP; ?>" id="optionRadios<?php echo $row2->id_nilaibobot_WP; ?>" value="<?php echo $row2->id_nilaibobot_WP; ?>">
                                    <input type="text" name="kode_sub<?php echo $row2->kode_subkriteria_WP; ?>" value="<?php echo $row2->kode_subkriteria_WP; ?>" hidden>
                                  </span>
                              <input type="text" value="<?php echo $row2->nilai; ?>" class="form-control" disabled>
                            </div>
                    <?php 
                          }
                         
                        }?>
                    </div>
                  </div>
                  
                <?php }?>
                </div>
            </div>
            <div class="box-footer">
                <input type="submit" name="submit" class="btn btn-warning pull-right" value="SUBMIT" />
              </form>
            </div>

          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>