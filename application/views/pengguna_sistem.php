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
        <form action="<?php echo base_url();?>web/submit_pengguna_sistem" method="post" enctype="multipart/form-data">

          <div class="col-md-12">
            <div class="form-group col-lg-6">
              <label>NIP</label>
                <input type="text" name="nim" class="form-control" placeholder="Masukkan No Induk Pegawai">
              <?php echo form_error('nim'); ?>
            </div>
            <div class="form-group col-lg-6">
              <label>Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Pegawai">
              <?php echo form_error('name'); ?>
            </div>
            <div class="form-group col-lg-6">
              <label>Jabatan</label>
                <select name="jabatan" class="form-control">
                  <?php foreach($jabatan->result_array() as $ku){?>
                    <option value="<?php echo $ku['nama_jabatan'];?>">
                      <?php echo $ku['nama_jabatan'];?>
                    </option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group col-lg-6">
              <label>Akses Sistem</label>
              <select name="hak_akses" class="form-control">
                <option value="" disabled selected>Pilih Hak Akses</option>
                <option value="1">ADMIN</option>
                <option value="2">KARYAWAN</option>
                <option value="4">PIMPINAN PMW</option>
              </select>
            </div>
            <div class="form-group col-lg-6">
              <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
              <?php echo form_error('password'); ?>
            </div>
          </div>
            <button class="btn btn-warning pull-right">Submit</button>
        </form>
      </div>
      <div class="box-footer">

      </div>
    </div>
    <!-- Box Isi Data-->
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title"></h3>
      </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><center>No</center></th>
              <th><center>Username</center></th>
              <th><center>Nama</center></th>
              <th><center>jabatan</center></th>
              <th><center>Akses Sistem</center></th>
              <th><center>Aksi</center></th>
             </tr>
          </thead>
          <tbody>
              <?php
              $no=1;
              foreach($all_pengguna->result_array() as $data)
              {
              ?>
                <tr>
                  <td width="20px"><center><?php echo $no;?></center></td>
                  <td><center><?php echo $data['nim'];?></center></td>
                  <td><center><?php echo $data['nama'];?></center></td>
                  <td><center><?php echo $data['jabatan'];?></center></td>
                  <td>
                    <center><?php if($data['hak_akses']=='1'){ echo "ADMIN";}?></center>
                    <center><?php if($data['hak_akses']=='2'){ echo "KARYAWAN";}?></center>
                    <center><?php if($data['hak_akses']=='3'){ echo "---";}?></center>
                    <center><?php if($data['hak_akses']=='4'){ echo "PIMPINAN";}?></center>
                    <center><?php if($data['hak_akses']=='5'){ echo "--";}?></center>
                  </td>
                  <td width="100px"><center>
                    <a href="<?php echo base_url('web/edit_pengguna_sistem');?>/<?php echo $data['id_pengguna'];?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                    <a onClick="return confirmSubmit()" href="<?php echo base_url('web/hapus_pengguna_sistem');?>/<?php echo $data['id_pengguna'];?>"><button class="btn  btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></a></center>
                  </td>
                </tr>
              <?php
                $no++;
              }?>
          </tbody>
        </table>
      </div>
      <div class="box-footer">

      </div>
    </div>

  </section>
  <!-- /.Left col -->
</div>
<!-- /.row (main row) -->
</section>
