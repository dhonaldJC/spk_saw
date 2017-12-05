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
              <form action="<?php echo base_url();?>web/submit_jabatan" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                  <div class="form-group col-lg-6">
                    <label>Kode Jabatan</label>
                      <input type="text" name="kode_jabatan" class="form-control" placeholder="Masukkan Kode jabatan">
                    <?php echo form_error('kode_jabatan'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Nama Jabatan</label>
                      <input type="text" name="nama_jabatan" class="form-control" placeholder="Masukkan Nama jabatan">
                    <?php echo form_error('nama_jabatan'); ?>
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
                    <th><center>Kode jabatan</center></th>
                    <th><center>Nama jabatan</center></th>
                    <th><center>Aksi</center></th>
                   </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach($jabatan->result_array() as $data)
                    {
                    ?>
                      <tr>
                        <td width="20px"><center><?php echo $no;?></center></td>
                        <td><center><?php echo $data['kode_jabatan'];?></center></td>
                        <td><center><?php echo $data['nama_jabatan'];?></center></td>
                        <td width="100px"><center>
                          <a href="<?php echo base_url('web/edit_jabatan');?>/<?php echo $data['id_jab'];?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                          <a onClick="return confirmSubmit()" href="<?php echo base_url('web/hapus_jabatan');?>/<?php echo $data['id_jab'];?>"><button class="btn  btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></a></center>
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