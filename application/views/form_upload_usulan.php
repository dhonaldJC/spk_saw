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
      <table id="example2" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th><center>Syarat</center></th>
            <th><center>Jenis Dokumen</center></th>
            <th><center>Status</center></th>
            <th><center>Aksi</center></th>
          </tr>
        </thead>
        <tbody>
                <tr>
                  <td> Curiculum Vitae Anggota Pengusul</td>
                  <td> Dokumen Word (Sesuai format pada halaman form usulan usaha)</td>
                  <td> File Belum Upload</td>
                  <td><center>
                  <a onClick="return confirmSubmit()" href="">
                      <button class="btn btn-success btn-xs">
                        <i class="fa fa-upload"> UPLOAD</i>
                      </button>
                    </a></center>
                </td>
                </tr>
                <tr>
                  <td> Cashflow</td>
                  <td> Cashflow (Sesuai format pada halaman form usulan usaha)</td>
                  <td> File Belum Upload</td>
                  <td><center>
                  <a onClick="return confirmSubmit()" href="">
                      <button class="btn btn-success btn-xs">
                        <i class="fa fa-upload"> UPLOAD</i>
                      </button>
                    </a></center>
                </td>
                </tr>
                <tr>
                  <td> Pernyataan Mengikuti Pelatihan</td>
                  <td> Pernyataan Mengikuti Pelatihan (Sesuai format pada halaman form usulan usaha)</td>
                  <td> File Belum Upload</td>
                  <td><center>
                  <a onClick="return confirmSubmit()" href="">
                      <button class="btn btn-success btn-xs">
                        <i class="fa fa-upload"> UPLOAD</i>
                      </button>
                    </a></center>
                </td>
                </tr>
                <tr>
                  <td> Scan Kartu Mahasiswa Anggota Pengusul</td>
                  <td> Dokumen Word (Sesuai format pada halaman form usulan usaha)</td>
                  <td> File Belum Upload</td>
                  <td><center>
                  <a onClick="return confirmSubmit()" href="">
                      <button class="btn btn-success btn-xs">
                        <i class="fa fa-upload"> UPLOAD</i>
                      </button>
                    </a></center>
                </td>
                </tr>
        </tbody>
      </table>

    </div>
    <!-- Box Isi Data-->
  </section>
</div>
<!-- /.row (main row) -->
</section>
