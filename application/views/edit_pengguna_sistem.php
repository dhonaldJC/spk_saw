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
      <?php foreach($edit_user->result_array() as $rows)?>
        <form action="<?php echo base_url();?>web/update_pengguna_sistem" method="post" enctype="multipart/form-data">

          <div class="col-md-12">
            <div class="form-group col-lg-6">
              <label>NIP</label>
                <input type="hidden" name="id_pengguna" value="<?php echo $rows['id_pengguna'];?>"/>
                <input type="text" name="nim" value="<?php echo $rows['nim'];?>" class="form-control">
              <?php echo form_error('nim'); ?>
            </div>
            <div class="form-group col-lg-6">
              <label>Nama</label>
                <input type="text" name="name" value="<?php echo $rows['name'];?>" class="form-control">
              <?php echo form_error('name'); ?>
            </div>
            <div class="form-group col-lg-6">
              <label>jabatan</label>
                <select name="jabatan" class="form-control">
                  <?php foreach($jabatan->result_array() as $ku){?>
                    <option value="<?php echo $ku['nama_jabatan'];?>">
                      <?php echo $ku['nama_jabatan'];?>
                    </option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group col-lg-6">
              <label>HAK AKSES</label>
              <select name="hak_akses" class="form-control">
                <option value="" disabled selected>
                  <?php if($rows['hak_akses']=='1'){ echo "ADMIN";}?>
                  <?php if($rows['hak_akses']=='3'){ echo "KARYAWAN";}?>
                  <?php if($rows['hak_akses']=='2'){ echo "PIMPINAN";}?>
                </option>
                <option value="1">ADMIN</option>
                <option value="3">KARYAWAN</option>
                <option value="2">PIMPINAN</option>
              </select>
            </div>
            <div class="form-group col-lg-6">
              <label>password</label>
                <input type="password" name="password" value="<?php echo $rows['password'];?>" class="form-control">
              <?php echo form_error('password'); ?>
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
