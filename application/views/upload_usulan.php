<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 connectedSortable">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Form Upload Lampiran Usulan Usaha</h3>
      </div>
      <div class="box-body">

      <?php foreach($usulan->result_array() as $kode_usulan)?>
      <!-- Upload File -->
      <div class="box-body">
        <form action="<?php echo base_url();?>web/uploading_cashflow" method="post" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="form-group col-lg-10">
              <label class="control-label col-md-5">Cashflow</label>
              <div class="col-md-4">
                <input type="hidden" name="kode_usulan" value="<?php echo $kode_usulan['kode_usulan']; ?>">
                <input type="file" name="userfile" class="form-control col-md-7 col-xs-12">
              </div>
              <button class="btn btn-warning">Save</button>
            </div>
          <div></div>
          </div>
        </form>
      </div>
      <div class="box-footer"></div>

      <div class="box-body">
        <form action="<?php echo base_url();?>web/uploading_kpm" method="post" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="form-group col-lg-10">
              <label class="control-label col-md-5">File Scan Kartu Mahasiswa Anggota Pengusul</label>
              <div class="col-md-4">
                <input type="hidden" name="kode_usulan" value="<?php echo $kode_usulan['kode_usulan']; ?>">
                <input type="file" name="userfile" class="form-control col-md-7 col-xs-12">
              </div>
              <button class="btn btn-warning">Save</button>
            </div>
          </div>
        </form>
      </div>
      <div class="box-footer"></div>

      <div class="box-body">
        <form action="<?php echo base_url();?>web/uploading_cv" method="post" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="form-group col-lg-10">
              <label class="control-label col-md-5">File Curiculum Vitae Anggota Pengusul</label>
              <div class="col-md-4">
                <input type="hidden" name="kode_usulan" value="<?php echo $kode_usulan['kode_usulan']; ?>">
                <input type="file" name="userfile" class="form-control col-md-7 col-xs-12">
              </div>
              <button class="btn btn-warning">Save</button>
            </div>
          </div>
        </form>
      </div>
      <div class="box-footer"></div>

      <div class="box-body">
        <form action="<?php echo base_url();?>web/uploading_pernyataanpelatihan" method="post" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="form-group col-lg-10">
              <label class="control-label col-md-5">File Pernyataan Mengikuti Pelatihan</label>
              <div class="col-md-4">
                <input type="hidden" name="kode_usulan" value="<?php echo $kode_usulan['kode_usulan']; ?>">
                <input type="file" name="userfile" class="form-control col-md-7 col-xs-12">
              </div>
              <button class="btn btn-warning">Save</button>
            </div>
          </div>
        </form>
      </div>
      <div class="box-footer"></div>

    </div>
    <!-- Box Isi Data-->
  </section>
</div>
<!-- /.row (main row) -->
</section>
