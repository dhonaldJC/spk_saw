      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Penilaian Usulan Usaha Tahap Pertama [TAHAP 1]</h3>
            </div>
            </br>
            <div class="box-body">
              <form action="<?php echo base_url();?>web/getpenilaian" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                  
                  <?php foreach($na_usulan->result_array() as $data){?>
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12">Nama Usaha</label>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                      <input type="text" name="kode_usulan" value="<?php echo $data['kode_usulan']; ?>" hidden>
                      <input type="text" name="nama_usaha" value="<?php echo $data['nama_usaha']; ?>" class="form-control" placeholder="Masukkan Nama Usaha">
                    <?php echo form_error('nama_usaha'); }?>
                    </div>
                  </div>


                  <?php  foreach($label->result() as $row){ ?>
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-4 col-sm-3 col-xs-12"><?php echo $row->kriteria; ?></label>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                      <?php  
                        foreach($kategori->result() as $row2){
                          if ($row2->id_kriteria == $row->id_kriteria && $row2->type=="radio") {?>
                            <div class="input-group">
                                  <span class="input-group-addon">
                                    <input type="radio" name="kategori<?php echo $row2->id_kategorikrit_elektre; ?>" id="optionRadios<?php echo $row2->id_kategorikrit_elektre; ?>" value="<?php echo $row2->id_kategorikrit_elektre; ?>" >
                                  </span>
                              <input type="text" value="<?php echo $row2->kategori; ?>" class="form-control" disabled>
                            </div>
                    <?php 
                          }
                          elseif ($row2->id_kriteria == $row->id_kriteria && $row2->type=="select") {?>
                            <select name="kelayakan_biaya" class="form-control">
                                <option>-------Pilih----------</option>
                                <option value="8"> ≤ 12.000.000</option>
                                <option value="9"> > 12.000.000 – 13.000.000</option>
                                <option value="10"> > 13.000.000 – 14.000.000</option>
                                <option value="11"> > 14.000.000</option>
                            </select>
                    <?php break;
                          }
                          elseif ($row2->id_kriteria == $row->id_kriteria && $row2->type=="select2") {?>
                            <select name="kreatifitas" class="form-control">
                                <option>-------Pilih----------</option>
                                <option value="17"> Baru, produk bervariasi</option>
                                <option value="18"> Baru, produk tidak bervariasi</option>
                                <option value="19"> Pengembangan, produk bervariasi</option>
                                <option value="20"> Pengembangan, produk tidak bervariasi</option>
                            </select>
                    <?php break;
                          }
                          elseif ($row2->id_kriteria == $row->id_kriteria && $row2->type=="select3") {?>
                            <select name="kebutuhan_masyarakat" class="form-control">
                                <option>-------Pilih----------</option>
                                <option value="21"> Sangat Bermanfaat</option>
                                <option value="22"> Bermanfaat</option>
                                <option value="23"> Cukup Bermanfaat</option>
                            </select>
                    <?php break;
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