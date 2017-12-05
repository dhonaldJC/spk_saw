      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Proposal Usaha Lolos <strong>Tahap Seleksi Akhir</strong></h3>
            </div>
            </br>
            <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
            <thead>
               <tr>
                  <th colspan="1" rowspan="4"><center>Nama Usaha</center></th>
                  <th colspan="4"><center>Data</center></th>
               </tr>
               <tr>
                  <th><center> Nim Ketua Pengusul</center></th>
                  <th><center> Dosen Pembimbing</center></th>
                  <th><center> Fakultas</center></th>
                  <th><center> Kategori Usaha</center></th>
                  <th><center> Nilai Rekomendasi</center></th>
               </tr>
            </thead>
            <tbody>
  <?php
  // kecocokan nilai pmw (get data evalutasi elektre)
  // SELECT u.kode_usulan, swp.subkriteria, SUM(nwp.bobot_nilaiWP) AS jumlah FROM evaluation_wp ewp JOIN usulan u ON u.kode_usulan=ewp.kode_usulan JOIN subkriteria_wp swp ON swp.kode_subkriteria_WP=ewp.kode_subkriteria_WP JOIN nilai_bobot_wp nwp ON nwp.id_nilaibobot_WP=ewp.id_nilaibobot_WP JOIN kriteria_wp kwp ON kwp.kode_kriteria_WP=swp.kode_kriteria_WP GROUP BY kwp.kode_kriteria_WP

  // SELECT * FROM evaluation_elektre e JOIN kategori_kriteria_elektre  ker ON ker.id_kategorikrit_elektre = e.id_kategorikrit_elektre JOIN usulan u ON u.kode_usulan=e.kode_usulan JOIN nilai_bobot_elektre ne ON ne.id_nilaibobot_elektre = e.id_nilaibobot_elektre JOIN kriteria_elektre kre ON kre.id_kriteria = ker.id_kriteria ORDER BY ker.kategori DESC

        $pengusul   =   $this->db
                             ->join('evaluation_wp k','k.kode_usulan=p.kode_usulan')
                             ->group_by('p.kode_usulan')
                             ->order_by('k.id_evaluation_wp','asc')
                             ->get('usulan p');
        $in          =   0;
        $jpengusul  =   0;
        foreach($pengusul->result() as $row){

          $jpengusul++;
          $in        =   0;

            foreach($get_eval->result() as $row2){
              $a[$row->kode_usulan][$in]=$row2->jumlah;
              $in++;
            }
        
        }
          $bobot      =   $this->Web_model->getAlldatabobotkriteria();
          $batas      =   $in;
          if ($batas != 0) {
                    $bobotpertanyaan    =   $this->Web_model->getAlldatapertanyaan();
                    $wb   =   0;
                    foreach($bobotpertanyaan->result() as $row){
                      $wb   =   $row->bobot_nilaiWP + $wb;
                    }

                    foreach($bobotpertanyaan->result() as $row){
                      $w = $row->bobot_nilaiWP / $wb;
                    }


                    foreach ($usulan_wp->result() as $terpilih) {
                      if($terpilih->kode_usulan != '0'){?>
                        <td><center><?php echo $terpilih->nama_usaha; ?></center></td>
                        <td><center><?php echo $terpilih->nim_ketua; ?></center></td>
                        <td><center><?php echo $terpilih->dosen_pembimbing; ?></center></td>
                        <td><center><?php echo $terpilih->fakultas; ?></center></td>
                        <td><center><?php echo $terpilih->nama_kategori_usaha; ?></center>
                        <td><center><?php echo $w; ?></center>
                <?php }
                    }
          }
        ?>            </tbody>
            </table>

            </div>
          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>