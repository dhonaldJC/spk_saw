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
            <?php foreach($edit_ku->result_array() as $row)?>
              <form action="<?php echo base_url();?>web/update_kategori_usaha" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                  <div class="form-group col-lg-6">
                    <label>Kode Kategori Usaha</label>
                      <input type="hidden" name="id_ku" value="<?php echo $row['id_ku'];?>"/>
                      <input type="text" name="kode_kategori_usaha" value="<?php echo $row['kode_kategori_usaha'];?>" class="form-control">
                    <?php echo form_error('kode_kategori_usaha'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Nama Kategori Usaha</label>
                      <input type="text" name="nama_kategori_usaha" value="<?php echo $row['nama_kategori_usaha'];?>" class="form-control">
                    <?php echo form_error('nama_kategori_usaha'); ?>
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