      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box box-warning">
            <div class="box-header">
              <h1 class="box-title"><strong>Table 1 - Nilai Awal</strong></h1>
            </div>
          <!-- Box Input Data-->
            <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <tr class="active">
                            <th class="col-md-1 text-center">No</th>
                            <?php
                            $no = 1;
                            $table = $this->page->getData('table1');
                              foreach ($table as $item => $value) {
                                foreach ($value as $heading => $itemValue) { ?>
                            <th class="text-center"><?php echo $heading ?></th>
                          <?php } break;
                              } ?>
                        </tr>
                        <?php
                          foreach ($table as $item => $value) { ?>
                            <tr>
                              <td class="text-center"><?php echo $no ?></td>
                              <?php
                              foreach ($value as $itemValue) { ?>
                              <td> <?php echo $itemValue ?> </td>
                              <?php } ?>
                            </tr>
                          <?php $no++; 
                          }
                        ?>
                    </table>
            </div>
            <div class="box-footer"> </div>
          </div>
          <div class="box box-warning">
            <div class="box-header">
              <h1 class="box-title"><strong>Table 1 - Nilai Awal</strong></h1>
            </div>
          <!-- Box Input Data-->
            <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <tr class="active">
                            <th class="col-md-1 text-center">No</th>
                            <?php
                            $no = 1;
                            $table = $this->page->getData('table1');
                              foreach ($table as $item => $value) {
                                foreach ($value as $heading => $itemValue) { ?>
                            <th class="text-center"><?php echo $heading ?></th>
                          <?php } break;
                              } ?>
                        </tr>
                        <?php
                          foreach ($table as $item => $value) { ?>
                            <tr>
                              <td class="text-center"><?php echo $no ?></td>
                              <?php
                              foreach ($value as $itemValue) { ?>
                              <td> <?php echo $itemValue ?> </td>
                              <?php } ?>
                            </tr>
                          <?php $no++; 
                          }
                        ?>
                    </table>
            </div>
            <div class="box-footer"> </div>
          </div>
        </section>
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->
    </section>