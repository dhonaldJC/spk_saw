      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
          <!-- Box Input Data-->
            <div class="box-body">
            <?php foreach($edit_saw->result_array() as $row)?>
              <form action="<?php echo base_url();?>web/update_kriteria_saw" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                  <div class="form-group col-lg-6">
                    <label>Kode Kriteria</label>
                    <input type="hidden" name="id_kriteria_SAW" value="<?php echo $row['id_kriteria_SAW'];?>"/>
                      <input type="text" name="kode_kriteria_SAW" value="<?php echo $row['kode_kriteria_SAW'];?>" class="form-control">
                    <?php echo form_error('kode_kriteria_SAW'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Nama Kriteria</label>
                      <input type="text" name="kriteria_SAW" value="<?php echo $row['kriteria_SAW'];?>" class="form-control">
                    <?php echo form_error('kriteria_SAW'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Bobot Kriteria</label>
                      <input type="text" name="bobot_kriteria_SAW" value="<?php echo $row['bobot_kriteria_SAW'];?>" class="form-control">
                    <?php echo form_error('bobot_kriteria_SAW'); ?>
                  </div>
                </div>
                  <button class="btn btn-warning pull-right">Update</button>
              </form>
            </div>
            <div class="box-footer">

            </div>
          </div>
        </section>
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->
    </section>