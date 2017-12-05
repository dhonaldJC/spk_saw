      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Proposal Usaha Lolos <strong> Tahap Seleksi 1 (Pertama)</strong></h3>
            </div>
            </br>
            <div class="box-body">

            <form action="<?php echo base_url();?>Web/submit_tahap_pertama" method="post" enctype="multipart/form-data" data-parsley-validate>
            <table id="example1" class="table table-bordered table-striped">
            <thead>
               <tr>
                  <th colspan="1" rowspan="3"><center>Nama Usaha</center></th>
                  <th colspan="3"><center>Data</center></th>
               </tr>
               <tr>
                  <th><center> Nim Ketua Pengusul</center></th>
                  <th><center> Dosen Pembimbing</center></th>
                  <th><center> Fakultas</center></th>
                  <th><center> Kategori Usaha</center></th>
               </tr>
            </thead>
            <tbody>
  <?php
  // kecocokan nilai pmw (get data evalutasi elektre)
  // SELECT e.kode_usulan,SUM(ne.bobot) as jumlah FROM evaluation_elektre e JOIN kategori_kriteria_elektre  ker ON ker.id_kategorikrit_elektre = e.id_kategorikrit_elektre JOIN usulan u ON u.kode_usulan=e.kode_usulan JOIN nilai_bobot_elektre ne ON ne.id_nilaibobot_elektre = e.id_nilaibobot_elektre JOIN kriteria_elektre kre ON kre.id_kriteria = ker.id_kriteria GROUP BY kre.id_kriteria

  // SELECT * FROM evaluation_elektre e JOIN kategori_kriteria_elektre  ker ON ker.id_kategorikrit_elektre = e.id_kategorikrit_elektre JOIN usulan u ON u.kode_usulan=e.kode_usulan JOIN nilai_bobot_elektre ne ON ne.id_nilaibobot_elektre = e.id_nilaibobot_elektre JOIN kriteria_elektre kre ON kre.id_kriteria = ker.id_kriteria ORDER BY ker.kategori DESC

        $pengusul=$this->db
                        ->join('evaluation_elektre k','k.kode_usulan=p.kode_usulan')
                        ->group_by('p.kode_usulan')
                        ->order_by('k.id_evaluation_elektre','asc')
                        ->get('usulan p');

        $i          =   0;
        $jpengusul  =   0;
        foreach($pengusul->result() as $row){

          $jpengusul++;
          $i        =   0;

            foreach($get_eval->result() as $row2){
              $a[$row->kode_usulan][$i]=$row2->jumlah;
              $i++;
            }
        }

        $batas      =   $i;
        if ($batas != 0) {

            for($i = 0; $i< $batas; $i++){

              $pembagi = 0;

                foreach($pengusul->result() as $row){
                  $pembagi = pow($a[$row->kode_usulan][$i],2) + $pembagi;
                } $bagi[$i] = sqrt($pembagi);
            }

            foreach($pengusul->result() as $row){
                for($i = 0; $i < $batas; $i++){
                  $b[$row->kode_usulan][$i] = $a[$row->kode_usulan][$i]/$bagi[$i];
               }
            }

            $gb   =   $this->db->get("kriteria_elektre");
            $j    =   0;
              foreach($gb->result() as $row){
                $bobot[$j] = $row->bobot_kriteria;
                $j++;
              }

            foreach($pengusul->result() as $row){
              for($i = 0; $i < $batas; $i++){
                $c[$row->kode_usulan][$i] = $b[$row->kode_usulan][$i]*$bobot[$i];
              }
            }

            $ss = 1;
            foreach($pengusul->result() as $row){
              foreach($pengusul->result() as $row2){

                $sumc = 0;
                if($row->kode_usulan != $row2->kode_usulan){

                  for($i = 0; $i < $batas; $i++){

                    if($c[$row->kode_usulan][$i] >= $c[$row2->kode_usulan][$i]){
                      $sumc = $bobot[$i] + $sumc;
                    }

                  } $concordance[$row->kode_usulan][$row2->kode_usulan] = $sumc;

                } else{
                    $concordance[$row->kode_usulan][$row2->kode_usulan] = 0;
                  }
              }
            }

            $sumcon = 0;
            foreach($pengusul->result() as $row){

              foreach($pengusul->result() as $row2){
                $sumcon = @($concordance[$row->kode_usulan][$row2->kode_usulan] + $sumcon);
              }
            }

            foreach($pengusul->result() as $row){

              foreach($pengusul->result() as $row2){
                if($row->kode_usulan != $row2->kode_usulan){
                  $sor = 0; $dor = 0;
                  for($k = 0; $k < $batas; $k++){

                    if($c[$row->kode_usulan][$k] < $c[$row2->kode_usulan][$k]){
                      $iso[$sor] = abs($c[$row->kode_usulan][$k] - $c[$row2->kode_usulan][$k]);
                      $sor++;
                    } else{
                      $iso[$sor] = 0;
                      $sor++;
                      }
                        $oso[$dor] = abs($c[$row->kode_usulan][$k] - $c[$row2->kode_usulan][$k]);
                        $dor++;
                  }

                    if(max($oso) == 0){
                      $dis[$row->kode_usulan][$row2->kode_usulan] = 0;
                    } else{
                        $dis[$row->kode_usulan][$row2->kode_usulan] = max($iso)/max($oso);
                      }

                } else{
                    $dis[$row->kode_usulan][$row2->kode_usulan] = 0;
                  }
              }
            }

            $sumdis = 0;
            foreach($pengusul->result() as $row){
              foreach($pengusul->result() as $row2){
                $sumdis   =   @($dis[$row->kode_usulan][$row2->kode_usulan]+$sumdis);
              }
            }
            $bagi         =   count($pengusul->result())*(count($pengusul->result())-1);
            $thresholdc   =   @($sumcon/$bagi);
            $thresholdd   =   @($sumdis/$bagi);

            foreach($pengusul->result() as $row){
              foreach($pengusul->result() as $row2){

                if($concordance[$row->kode_usulan][$row2->kode_usulan]>=$thresholdc){
                  $f[$row->kode_usulan][$row2->kode_usulan]     =   1;
                } else{
                    $f[$row->kode_usulan][$row2->kode_usulan]   =   0;
                 }

                if($dis[$row->kode_usulan][$row2->kode_usulan]  >=  $thresholdd){
                  $g[$row->kode_usulan][$row2->kode_usulan]     =   1;
                } else{
                    $g[$row->kode_usulan][$row2->kode_usulan]   =   0;
                  }
              }
            }

            foreach($pengusul->result() as $row){
              foreach($pengusul->result() as $row2){
                $f[$row->kode_usulan][$row2->kode_usulan];
              }
            }

            foreach($pengusul->result() as $row){
              foreach($pengusul->result() as $row2){
                $g[$row->kode_usulan][$row2->kode_usulan];
              }
            }

            foreach($pengusul->result() as $row){
              foreach($pengusul->result() as $row2){
                $e[$row->kode_usulan][$row2->kode_usulan]   =   $f[$row->kode_usulan][$row2->kode_usulan] * $g[$row->kode_usulan][$row2->kode_usulan];
              }
            }

            foreach($pengusul->result() as $row){
              $totelectre[$row->kode_usulan]    =   0;
              foreach($pengusul->result() as $row2){
               $totelectre[$row->kode_usulan]   =   $e[$row->kode_usulan][$row2->kode_usulan] + $totelectre[$row->kode_usulan];
              }
            }

            foreach($pengusul->result() as $row){
              if(max($totelectre) == $totelectre[$row->kode_usulan]){
                $elec = $row->kode_usulan;
              }
            }

            foreach($gb->result() as $rgb){

              $getrata  =   $this->Web_model->getdataevaluation_elektrebykategori($elec,$rgb->id_kriteria);
              $i        =   1;
              $nilai    =   0;
              foreach($getrata->result() as $gr){
                $nilai  =   $gr->bobot + $nilai;
                $i++;
                $usulan_terpilih = $gr->kode_usulan;
              }

              $electre['data'][] = array(
                                  "nama_kriteria" =>$rgb->kriteria,
                                  "nilai"  => ($nilai/($i*5))*100
              );
            }

            foreach ($usulan_elektre->result() as $terpilih) {
              if($usulan_terpilih == $terpilih->kode_usulan){?>
                <td><center><?php echo $terpilih->nama_usaha; ?></center></td>
                <td><center><?php echo $terpilih->nim_ketua; ?></center></td>
                <td><center><?php echo $terpilih->dosen_pembimbing; ?></center></td>
                <td><center><?php echo $terpilih->fakultas; ?></center></td>
                <td><center><?php echo $terpilih->nama_kategori_usaha; ?></center>
                  <input type="hidden" name="kode_usulan" value="<?php echo $terpilih->kode_usulan;?>"/>
                  <input type="hidden" name="nama_usaha" value="<?php echo $terpilih->nama_usaha;?>"/>
                  <input type="hidden" name="kode_kategori_usaha" value="<?php echo $terpilih->kode_kategori_usaha;?>"/>
                  <input type="hidden" name="nim_ketua" value="<?php echo $terpilih->nim_ketua;?>"/>
                  <input type="hidden" name="dosen_pembimbing" value="<?php echo $terpilih->dosen_pembimbing;?>"/>
                </td>
        <?php }
            }
        }
        ?>
            </tbody>
            </table>
            <div class="panel-footer">
              <button type="submit" class="btn btn-warning pull-right"> Simpan Seleksi Tahap Pertama </button>
            </div>
            </form>

            </div>
          </div>
          <!-- Box Isi Data-->
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>