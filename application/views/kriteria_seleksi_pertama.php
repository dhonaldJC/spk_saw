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
                    <th><center>Kriteria Tahap Pertama</center></th>
                    <th><center>Bobot</center></th>
                    <th><center>Kategori Penilaian</center></th>
                    <th><center>Peniliaian Tahap Pertama</center></th>
                    <th><center>Nilai Bobot Penilaian Tahap Pertama</center></th>
                   </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach($kriteria_first->result_array() as $data)
                    {
                    ?>
                      <tr>
                        <td width="20px"><center><?php echo $no;?></center></td>
                        <td><center><?php echo $data['kriteria'];?></center></td>
                        <td><center><?php echo $data['bobot_kriteria'];?></center></td>
                        <td><center><?php echo $data['kategori'];?></center></td>
                        <td><center><?php echo $data['nilai'];?></center></td>
                        <td><center><?php echo $data['bobot'];?></center></td>
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