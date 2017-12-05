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
            <?php foreach($edit_ju->result_array() as $row)?>
              <form action="<?php echo base_url();?>web/update_jenis_usaha" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                  <div class="form-group col-lg-6">
                    <label>Kode Jenis Usaha</label>
                      <input type="hidden" name="id_ju" value="<?php echo $row['id_ju'];?>"/>
                      <input type="text" name="kode_jenis_usaha" value="<?php echo $row['kode_jenis_usaha'];?>" class="form-control">
                    <?php echo form_error('kode_jenis_usaha'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Nama Jenis Usaha</label>
                      <input type="text" name="nama_jenis_usaha" value="<?php echo $row['nama_jenis_usaha'];?>" class="form-control">
                    <?php echo form_error('nama_jenis_usaha'); ?>
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
