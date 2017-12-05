      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Form Usulan Usaha</h3>
            </div>
            <div class="box-body">
            <center><h2 class="box-title">Download Format Document Upload Usulan Usaha</h2></center>
          </br>
              <div class="col-lg-1 col-xs-6"></div>
              <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h4>Proposal</h4>

                    <p>PMW UNSRI</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-cloud-download-outline"></i>
                  </div>
                  <a href="<?php echo base_url('uploads/format');?>/Format Proposal PMW UNSRI.doc" class="small-box-footer">Download Format <i class="fa fa-download"></i></a>
                </div>
              </div>

              <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h4>CASHFLOW</h4>

                    <p>Lampiran 1</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-cloud-download-outline"></i>
                  </div>
                  <a href="<?php echo base_url('uploads/format');?>/(Lampiran 1) CASHFLOW.doc" class="small-box-footer">Download Format <i class="fa fa-download"></i></a>
                </div>
              </div>

              <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h4>KPM FOTO</h4>

                    <p>Lampiran 2</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-cloud-download-outline"></i>
                  </div>
                  <a href="<?php echo base_url('uploads/format');?>/(Lampiran 2) KPM FOTO.doc" class="small-box-footer">Download Format <i class="fa fa-download"></i></a>
                </div>
              </div>

              <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h4>CV</h4>

                    <p>Lampiran 3</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-cloud-download-outline"></i>
                  </div>
                  <a href="<?php echo base_url('uploads/format');?>/(Lampiran 3) CV.doc" class="small-box-footer">Download Format <i class="fa fa-download"></i></a>
                </div>
              </div>

              <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h4>Pelatihan</h4>

                    <p>Lampiran 4</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-cloud-download-outline"></i>
                  </div>
                  <a href="<?php echo base_url('uploads/format');?>/(Lampiran 4) Form Kesediaan Mengikuti Pelatihan.doc" class="small-box-footer">Download Format <i class="fa fa-download"></i></a>
                </div>
              </div>
              </div>
              </br></br>
              <div class="box-footer"></div>
              <div class="box-body">
              <form action="<?php echo base_url();?>web/submit_usulan_usaha" method="post" enctype="multipart/form-data">
                <div class="col-md-12">

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Judul Usaha</label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                      <input type="text" name="nama_usaha" class="form-control" placeholder="Masukkan Nama Usaha">
                    <?php echo form_error('nama_usaha'); ?>
                    </div>
                  </div>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Kategori Usaha</label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                      <select name="kode_kategori_usaha" class="form-control">
                        <?php foreach($kategori_usaha->result_array() as $d){?>
                          <option value="<?php echo $d['kode_kategori_usaha'];?>">
                            <?php echo $d['nama_kategori_usaha'];?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Dosen Pembimbing</label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                      <input type="text" name="dosen_pembimbing" class="form-control" placeholder="(Masukkan Nama Dosen Pembimbing)">
                    <?php echo form_error('dosen_pembimbing'); ?>
                    </div>
                  </div>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Mahasiswa Pengusul</label>
                    <div class="col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" name="tipe_mhs" id="optionRadios1" value="Bidik Misi">
                          </span>
                          <input type="text" class="form-control" value="Bidik Misi" disabled="">
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" name="tipe_mhs" id="optionRadios2" value="Non Bidik Misi">
                          </span>
                          <input type="text" class="form-control" value="Non Bidik Misi" disabled="">
                        </div>
                      </div>
                  </div>

                  <?php foreach($pengguna->result_array() as $data){?>
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Ketua Pengusul</label>
                    <div class="col-md-4">
                      <input type="text" value="<?php echo $data['nama']; ?>" class="form-control" placeholder="(Ketua Pengusul)" disabled>
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="nim_ketua" value="<?php echo $data['nim']; ?>" class="form-control" placeholder="(Ketua Pengusul)" disabled>
                    </div>
                    <div class="col-md-3">
                      <input type="text" value="<?php echo $data['fakultas']; ?>" class="form-control" placeholder="(Ketua Pengusul)" disabled>
                      <input type="hidden" name="nim_ketua" value="<?php echo $data['nim']; ?>" class="form-control" placeholder="(Ketua Pengusul)">
                    </div>
                  </div>
                  <?php } ?>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Anggota</label>
                    <div class="col-md-4">
                      <input type="text" name="nama_anggota1" class="form-control" placeholder="NAMA">
                    <?php echo form_error('nama_anggota1'); ?>
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="nim_anggota1" class="form-control" placeholder="NIM">
                    <?php echo form_error('nim_anggota1'); ?>
                    </div>
                    <div class="col-md-3">
                      <select name="fak_anggota1" class="form-control">
                        <option value="" disabled selected>Pilih Fakultas</option>
                        <?php foreach($fakultas->result_array() as $ku){?>
                          <option value="<?php echo $ku['nama_fakultas'];?>">
                            <?php echo $ku['nama_fakultas'];?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                    <div class="col-md-4">
                      <input type="text" name="nama_anggota2" class="form-control" placeholder="NAMA">
                    <?php echo form_error('nama_anggota2'); ?>
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="nim_anggota2" class="form-control" placeholder="NIM">
                    <?php echo form_error('nim_anggota2'); ?>
                    </div>
                    <div class="col-md-3">
                      <select name="fak_anggota2" class="form-control">
                        <option value="" disabled selected>Pilih Fakultas</option>
                        <?php foreach($fakultas->result_array() as $ku){?>
                          <option value="<?php echo $ku['nama_fakultas'];?>">
                            <?php echo $ku['nama_fakultas'];?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                    <div class="col-md-4">
                      <input type="text" name="nama_anggota3" class="form-control" placeholder="NAMA">
                    <?php echo form_error('nama_anggota3'); ?>
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="nim_anggota3" class="form-control" placeholder="NIM">
                    <?php echo form_error('nim_anggota3'); ?>
                    </div>
                    <div class="col-md-3">
                      <select name="fak_anggota3" class="form-control">
                        <option value="" disabled selected>Pilih Fakultas</option>
                        <?php foreach($fakultas->result_array() as $ku){?>
                          <option value="<?php echo $ku['nama_fakultas'];?>">
                            <?php echo $ku['nama_fakultas'];?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                    <div class="col-md-4">
                      <input type="text" name="nama_anggota4" class="form-control" placeholder="NAMA">
                    <?php echo form_error('nama_anggota4'); ?>
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="nim_anggota4" class="form-control" placeholder="NIM">
                    <?php echo form_error('nim_anggota4'); ?>
                    </div>
                    <div class="col-md-3">
                      <select name="fak_anggota4" class="form-control">
                        <option value="" disabled selected>Pilih Fakultas</option>
                        <?php foreach($fakultas->result_array() as $ku){?>
                          <option value="<?php echo $ku['nama_fakultas'];?>">
                            <?php echo $ku['nama_fakultas'];?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Email</label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                      <input type="text" name="email_usulan" class="form-control" placeholder="(Masukkan Email Pengusul)">
                    <?php echo form_error('email_usulan'); ?>
                    </div>
                  </div>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Jenis Usaha</label>
                      <div class="col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" name="jenis_usaha" id="optionRadios1" value="Usaha Baru">
                          </span>
                          <input type="text" class="form-control" value="Usaha Baru" disabled="">
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" name="jenis_usaha" id="optionRadios2" value="Pengembangan Usaha">
                          </span>
                          <input type="text" class="form-control" value="Pengembangan Usaha" disabled="">
                        </div>
                      </div>
                  </div>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Jumlah Dana yang Diusulkan</label>
                    <div class="col-md-5">
                      <input type="text" name="jml_dana_diusulkan" class="form-control" placeholder="Rp.">
                    <?php echo form_error('jml_dana_diusulkan'); ?>
                    </div>
                  </div>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Upload Proposal</label>
                    <div class="col-md-5">
                      <input type="file" name="userfile" class="form-control col-md-7 col-xs-12">
                    </div>
                    <div></div>
                  </div>

                </div>

                <div class=" form-group col-lg-10">
                  <button class="btn btn-warning pull-right">Submit</button>
                </div>
              </form>
            </div>
            <div class="box-footer"></div><br>
          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>
