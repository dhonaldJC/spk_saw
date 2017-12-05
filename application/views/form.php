      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Hasil Perhitungan Metode Elektre</h3>
            </div>
            </br>
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th colspan="1" rowspan="3"><center>Nama Usaha</center></th>
                    <th colspan="5"><center>Kriteria</center></th>
                   </tr>
                   <tr>
                    <th><center> Format Usulan</center></th>
                    <th><center> Kelayakan Biaya</center></th>
                    <th><center> Potensi Profit</center></th>
                    <th><center> Kreatifitas</center></th>
                    <th><center> Kebutuhan Masyarakat</center></th>
                   </tr>
                </thead>
                <tbody>
                <?php 
                foreach($all_elektre->result_array() as $data){?>
                  <tr>
                    <td><center><?php echo $data['nama_usaha']; ?></center></td>
                    <td><center><?php echo $data['format_usulan']; ?></center></td>
                    <td><center><?php echo $data['kelayakan_biaya']; ?></center></td>
                    <td><center><?php echo $data['potensi_profit']; ?></center></td>
                    <td><center><?php echo $data['kreatifitas']; ?></center></td>
                    <td><center><?php echo $data['kebutuhan_masyarakat']; ?></center></td>
                  </tr>

                  <?php
                        $bobot    =   $this->Web_model->criteria_elektre();
                        $batas    =   $this->db->count_all('usulan');
                        $no       =   0;
                        $notemp   =   $no;
                        echo $batas;

                  ?>



                <?php
                }?>
                </tbody>
              </table>

            </div>
          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>





      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Hasil Perhitungan Metode Elektre</h3>
            </div>
            </br>
            <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
            <thead>
               <tr>
                  <th colspan="1" rowspan="3"><center>Nama Usaha</center></th>
                  <th colspan="5"><center>Kriteria</center></th>
               </tr>
               <tr>
                  <th><center> Format Usulan</center></th>
                  <th><center> Kelayakan Biaya</center></th>
                  <th><center> Potensi Profit</center></th>
                  <th><center> Kreatifitas</center></th>
                  <th><center> Kebutuhan Masyarakat</center></th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $bobot    =   $this->Web_model->criteria_elektre();
                  $batas    =   $this->db->count_all('usulan');

                  foreach ($bobot->result_array() as $row) {
                     //--- inisialisasi jumlah kriteria 'n'
                     $n = $row['total'];
                  }

                  $X            =   array();
                  $alternative  =   '';
                  $m            =   0;

                  $alter  =   $this->Web_model->n_elektre();
                  foreach ($alter->result_array() as $rows) {
                    if ($rows[1]  !=  $alternative) {
                      echo '1';
                    }
                  }

                  
               ?>
            </tbody>
            </table>

            </div>
          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>









          <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Hasil Perhitungan Metode Elektre</h3>
            </div>
            </br>
            <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
            <thead>
               <tr>
                  <th colspan="1" rowspan="3"><center>Nama Usaha</center></th>
                  <th colspan="5"><center>Kriteria</center></th>
               </tr>
               <tr>
                  <th><center> Format Usulan</center></th>
                  <th><center> Kelayakan Biaya</center></th>
                  <th><center> Potensi Profit</center></th>
                  <th><center> Kreatifitas</center></th>
                  <th><center> Kebutuhan Masyarakat</center></th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $bobot    =   $this->Web_model->criteria_elektre();
                  $batas    =   $this->db->count_all('usulan');
                  $no       =   0;
                  $notemp   =   $no;

                  for ($i = 0; $i < $batas ; $i++) { 
                    for ($j = 0; $j <= 3 ; $j++) { 
                      if($no == $notemp){
                        if(($notemp + 1) % 4 == 0){
                          foreach($bobot->result() as $row2){
                            if($row->kategori == $row2->jumlah){
                              $kue  = $row2->bobot;
                            }
                          }
                        }else{
                          foreach($bobot->result() as $row2){
                            if($row->total == $row2->jumlah && $row->id_pertanyaan == $row2->id_pertanyaan){
                              $kue = $row2->bobot;
                            }elseif($row->total > 5 && $row->id_pertanyaan == 1){
                              $kue = 4;
                            }elseif($row->total > 3 && $row->id_pertanyaan == 2){
                              $kue = 3;
                            }
                          }
                        }
                      }else{
                        $notemp++;
                      }
                      $notemp = 0;
                      $no++;
                      $a[$i][$j] = $kue;
                    }
                  }

               ?>
            </tbody>
            </table>

            </div>
          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>








          <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Penilaian Usulan Usaha</h3>
            </div>
            </br>
            <div class="box-body">
              <form action="<?php echo base_url();?>web/penilaian_elektre" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                  
                  <?php foreach($na_usulan->result_array() as $data){?>
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Usaha</label>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                      <input type="text" name="kode_usulan" value="<?php echo $data['kode_usulan']; ?>" hidden>
                      <input type="text" name="nama_usaha" value="<?php echo $data['nama_usaha']; ?>" class="form-control" placeholder="Masukkan Nama Usaha">
                    <?php echo form_error('nama_usaha'); }?>
                    </div>
                  </div>

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Format Usulan</label>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="format[]">
                            </span>
                        <input type="text" value="Halaman Pengesahan" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="format[]">
                            </span>
                        <input type="text" value="Surat Izin Orang Tua/Wali" class="form-control" disabled>
                      </div>
                    </div>

                    <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="format[]">
                            </span>
                        <input type="text" value="Surat Kesediaan Dosen Pembina" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="format[]">
                            </span>
                        <input type="text" value="Curiculum Vitae (CV) " class="form-control" disabled>
                      </div>
                    </div>

                    <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="format[]">
                            </span>
                        <input type="text" value="Kartu Pengenal Mahasiswa (KPM)" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="format[]">
                            </span>
                        <input type="text" value="Form Pernyataan Kesediaan Peserta Mengikuti Pelatihan dan Pameran" class="form-control" disabled>
                      </div>
                    </div>

                    <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="format[]">
                            </span>
                        <input type="text" value="Form Pernyataan Kesediaan Pengembalian Dana Bergulir" class="form-control" disabled>
                      </div>
                    </div>
                    
                    <?php echo form_error('format_usulan'); ?>
                  </div>
                  
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Kelayakan Biaya</label>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                      <select name="kelayakan_biaya" class="form-control">
                          <option value="4"> ≤ 12.000.000</option>
                          <option value="3"> > 12.000.000 – 13.000.000</option>
                          <option value="2"> > 13.000.000 – 14.000.000</option>
                          <option value="1"> > 14.000.000</option>
                      </select>
                    </div>
                    <?php echo form_error('kelayakan_biaya'); ?>
                  </div>
                  
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Potensi Profit</label>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="potensi[]">
                            </span>
                        <input type="text" value="Pemasaran Online (Website)" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="potensi[]">
                            </span>
                        <input type="text" value="Area Kampus" class="form-control" disabled>
                      </div>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="potensi[]">
                            </span>
                        <input type="text" value="Area Perkantoran" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="potensi[]">
                            </span>
                        <input type="text" value="Area Sekolah" class="form-control" disabled>
                      </div>
                    </div>
                    <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                    <div class="col-lg-5">
                      <div class="input-group">
                            <span class="input-group-addon">
                              <input type="checkbox" name="potensi[]">
                            </span>
                        <input type="text" value="Pemukiman Masyarakat" class="form-control" disabled>
                      </div>
                    </div>
                    
                    <?php echo form_error('potensi_profit'); ?>
                  </div>                  

                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Kreatifitas</label>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                      <select name="kreatifitas" class="form-control">
                          <option value="4"> Baru, produk bervariasi</option>
                          <option value="3"> Baru, produk tidak bervariasi</option>
                          <option value="2"> Pengembangan, produk bervariasi</option>
                          <option value="1"> Pengembangan, produk tidak bervariasi</option>
                      </select>
                    </div>
                    <?php echo form_error('kreatifitas'); ?>
                  </div>
                  
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Kebutuhan Masyarakat</label>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                      <select name="kebutuhan_masyarakat" class="form-control">
                          <option value="4"> Sangat Bermanfaat</option>
                          <option value="3"> Bermanfaat</option>
                          <option value="2"> Cukup Bermanfaat</option>
                      </select>
                    </div>
                    <?php echo form_error('SELECT k.id_mahasiswa ,i.kategori,p.id_pertanyaan, COUNT(k.id_kategori) as total FROM  kuesioner k JOIN mahasiswa m ON m.id_mahasiswa=k.id_mahasiswa JOIN kategori i ON i.id_kategori=k.id_kategori JOIN pertanyaan p ON i.id_pertanyaan=p.id_pertanyaan GROUP BY k.id_mahasiswa, p.id_pertanyaan ORDER BY (k.id_mahasiswa) ASC');

                    ('SELECT k.kode_usulan, i.kategori, p.id_kriteria, COUNT(k.id_kategorikrit_elektre) as total FROM evaluation_elektre k JOIN usulan m ON m.kode_usulan=k.kode_usulan JOIN kategori_kriteria_elektre i ON i.id_kategorikrit_elektre=k.id_kategorikrit_elektre JOIN kriteria_elektre p ON i.id_kriteria=p.id_kriteria GROUP BY k.kode_usulan, p.id_kriteria ORDER BY (k.kode_usulan) ASC')

                    ('SELECT k.kode_usulan, i.kategori, p.id_kriteria, COUNT(k.id_kategorikrit_elektre) as total FROM evaluation_elektre k JOIN kategori_kriteria_elektre i ON i.id_kategorikrit_elektre=k.id_kategorikrit_elektre JOIN kriteria_elektre p ON i.id_kriteria=p.id_kriteria GROUP BY k.kode_usulan, p.id_kriteria ORDER BY (k.kode_usulan) ASC')

                    ('SELECT * FROM evaluation_elektre k JOIN kategori_kriteria_elektre i ON i.id_kategorikrit_elektre=k.id_kategorikrit_elektre JOIN kriteria_elektre p ON i.id_kriteria=p.id_kriteria ORDER BY (k.kode_usulan) ASC')?>


                  </div>

                </div>
            </div>
            <div class="box-footer">
                <input type="submit" name="submit" class="btn btn-warning pull-right" value="SUBMIT" />
              </form>
            </div>

          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>

          <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Penilaian Usulan Usaha</h3>
            </div>
            </br>
            <div class="box-body">
              <form action="<?php echo base_url();?>web/penilaian_elektre" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                  
                  <?php foreach($na_usulan->result_array() as $data){?>
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Nama Usaha</label>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                      <input type="text" name="kode_usulan" value="<?php echo $data['kode_usulan']; ?>" hidden>
                      <input type="text" name="nama_usaha" value="<?php echo $data['nama_usaha']; ?>" class="form-control" placeholder="Masukkan Nama Usaha">
                    <?php echo form_error('nama_usaha'); }?>
                    </div>
                  </div>


                  <?php  foreach($label->result() as $row){ ?>
                  <div class="form-group col-lg-10">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $row->kriteria; ?></label>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                      <?php  
                        foreach($kategori->result() as $row2){
                          if ($row2->id_kriteria == $row->id_kriteria && $row2->type=="checkbox") {?>
                            <div class="input-group">
                                  <span class="input-group-addon">
                                    <input type="checkbox" name="format[]">
                                  </span>
                              <input type="text" value="<?php echo $row2->kategori; ?>" class="form-control" disabled>
                            </div>
                    <?php 
                          }elseif ($row2->id_kriteria == $row->id_kriteria && $row2->type=="checkbox2") {?>
                            <div class="input-group">
                                  <span class="input-group-addon">
                                    <input type="checkbox" name="potensi[]">
                                  </span>
                              <input type="text" value="<?php echo $row2->kategori; ?>" class="form-control" disabled>
                            </div>
                          
                    <?php 
                          }elseif ($row2->id_kriteria == $row->id_kriteria && $row2->type=="select") {?>
                            <select name="kelayakan_biaya" class="form-control">
                                <option>-------Pilih----------</option>
                                <option value="8"> ≤ 12.000.000</option>
                                <option value="9"> > 12.000.000 – 13.000.000</option>
                                <option value="10"> > 13.000.000 – 14.000.000</option>
                                <option value="11"> > 14.000.000</option>
                            </select>
                    <?php break;
                          }elseif ($row2->id_kriteria == $row->id_kriteria && $row2->type=="select2") {?>
                            <select name="kreatifitas" class="form-control">
                                <option>-------Pilih----------</option>
                                <option value="17"> Baru, produk bervariasi</option>
                                <option value="18"> Baru, produk tidak bervariasi</option>
                                <option value="19"> Pengembangan, produk bervariasi</option>
                                <option value="20"> Pengembangan, produk tidak bervariasi</option>
                            </select>
                    <?php break;
                          }elseif ($row2->id_kriteria == $row->id_kriteria && $row2->type=="select3") {?>
                            <select name="kebutuhan_masyarakat" class="form-control">
                                <option>-------Pilih----------</option>
                                <option value="21"> Sangat Bermanfaat</option>
                                <option value="22"> Bermanfaat</option>
                                <option value="23"> Cukup Bermanfaat</option>
                            </select>
                    <?php break;
                          }
                        }?>
                    </div>
                  </div>
                  
                <?php }?>
                </div>
            </div>
            <div class="box-footer">
                <input type="submit" name="submit" class="btn btn-warning pull-right" value="SUBMIT" />
              </form>
            </div>

          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>


    $kategoriselect1      = $this->input->post('kelayakan_biaya');
    $dataeveluation_elektre = array(
      'kode_usulan' => $kode_usulan,
      'id_kategorikrit_elektre' => $kategoriselect1
      );
      $dataeveluation_elektre = $this->crud->insert("evaluation_elektre",$dataeveluation_elektre);

    $kategoriselect2      = $this->input->post('kreatifitas');
    $dataeveluation_elektre = array(
      'kode_usulan' => $kode_usulan,
      'id_kategorikrit_elektre' => $kategoriselect2
      );
      $dataeveluation_elektre = $this->crud->insert("evaluation_elektre",$dataeveluation_elektre);

    $kategoriselect3      = $this->input->post('kebutuhan_masyarakat');
    $dataeveluation_elektre = array(
      'kode_usulan' => $kode_usulan,
      'id_kategorikrit_elektre' => $kategoriselect3
      );
      $dataeveluation_elektre = $this->crud->insert("evaluation_elektre",$dataeveluation_elektre);