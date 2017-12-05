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
      <?php foreach($edit_user->result_array() as $row)?>
        <form action="<?php echo base_url();?>web/update_pengguna_sistem" method="post" enctype="multipart/form-data">

          <div class="col-md-12">
            <div class="form-group col-lg-6">
              <label>NIP</label>
                <input type="hidden" name="id_pengguna" value="<?php echo $row['id_pengguna'];?>"/>
                <input type="text" name="nim" value="<?php echo $row['nim'];?>" class="form-control">
              <?php echo form_error('nim'); ?>
            </div>
            <div class="form-group col-lg-6">
              <label>Nama</label>
                <input type="text" name="name" value="<?php echo $row['nama'];?>" class="form-control">
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
                  <?php if($row['hak_akses']=='1'){ echo "Staff PMW";}?>
                  <?php if($row['hak_akses']=='2'){ echo "Reviewer (Penilai jabatan)";}?>
                  <?php if($row['hak_akses']=='3'){ echo "Mahasiswa Pengusul";}?>
                  <?php if($row['hak_akses']=='4'){ echo "Pimpinan PMW";}?>
                  <?php if($row['hak_akses']=='5'){ echo "Evaluator PMW";}?>
                </option>
                <option value="1">STAFF PMW</option>
                <option value="2">REVIEWER</option>
                <option value="5">EVALUATOR</option>
                <option value="4">PIMPINAN PMW</option>
              </select>
            </div>
            <div class="form-group col-lg-6">
              <label>password</label>
                <input type="password" name="password" value="<?php echo $row['password'];?>" class="form-control">
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
