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
              <form action="<?php echo base_url();?>web/submit_penilaian_karyawan" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                  <div class="form-group col-lg-5">
                    <label>Karyawan</label>
                      <select name="nim" class="form-control">
                        <?php foreach($karyawan->result_array() as $ku){?>
                          <option value="" disabled selected>Pilih Karyawan</option>
                          <option value="<?php echo $ku['nim'];?>">
                            <?php echo $ku['name'];?>
                          </option>
                        <?php } ?>
                      </select>
                  </div>
                </div>
              <table class="table">
                <tr>
                  <th class="col-md-3">Indikator</th>
                  <th colspan="4" class="text-center col-md-9">Nilai</th>
                </tr>
                <?php
                foreach ($kriteria_saw as $item) { ?>
                <tr>
                  <td><?php echo $item['nama']?></td>
                  <?php 
                  $no = 1; 
                    foreach ($item['data'] as $dataItem) { ?>
                  
                  <td>
                    <input type="radio" name="nilai[<?php echo $dataItem->kode_kriteria_SAW ?>]" value="<?php echo $dataItem->value ?>"/>
                    <?php echo $dataItem->subKriteria;
                    $no++; ?>
                  </td>
                <?php
                  }
          echo '</tr>';
                  }
                  ?>
              </table>
                  <button class="btn btn-warning pull-right">Submit</button>
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