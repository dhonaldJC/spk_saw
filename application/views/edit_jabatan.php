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
            <?php foreach($edit_fak->result_array() as $row)?>
              <form action="<?php echo base_url();?>web/update_jabatan" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                  <div class="form-group col-lg-6">
                    <label>Kode Jabatan</label>
                    <input type="hidden" name="id_jab" value="<?php echo $row['id_jab'];?>"/>
                      <input type="text" name="kode_jabatan" value="<?php echo $row['kode_jabatan'];?>" class="form-control">
                    <?php echo form_error('kode_jabatan'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Nama Jabatan</label>
                      <input type="text" name="nama_jabatan" value="<?php echo $row['nama_jabatan'];?>" class="form-control">
                    <?php echo form_error('nama_jabatan'); ?>
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