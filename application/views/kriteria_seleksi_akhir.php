      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
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
                    <th><center>Kriteria Tahap Akhir</center></th>
                    <th><center>Bobot</center></th>
                    <th><center>Subkriteria Tahap Akhir</center></th>
                    <th><center>Peniliaian Tahap Akhir</center></th>
                    <th><center>Nilai Bobot Penilaian Tahap Akhir</center></th>
                   </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach($kriteria_final->result_array() as $data)
                    {
                    ?>
                      <tr>
                        <td width="20px"><center><?php echo $no;?></center></td>
                        <td><center><?php echo $data['kriteria_wp'];?></center></td>
                        <td><center><?php echo $data['bobot_kriteria_wp'];?></center></td>
                        <td><center><?php echo $data['subkriteria'];?></center></td>
                        <td><center><?php echo $data['nilai'];?></center></td>
                        <td><center><?php echo $data['bobot_nilaiWP'];?></center></td>
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