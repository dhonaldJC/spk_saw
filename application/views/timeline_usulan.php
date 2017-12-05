<!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-yellow">
                    Timeline Usulan PMW Universitas Sriwijaya
                  </span>
            </li>
            <!-- /.timeline-label -->
            <?php foreach ($pengguna->result() as $user)?>
            <!-- timeline item -->
            <li>
              <i class="fa fa-check-square-o bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Validasi Usulan</a></h3>

                <div class="timeline-body">
                 <?php
                  foreach ($validate->result() as $valid) {
                    if ($valid->validasi == "1" && $valid->nim_ketua == $user->nim) {
                      echo "Data Usulan PMW anda telah divalidasi dan akan diproses ke penilai fakultas untuk dilakukan penilaian";
                    } elseif ($valid->validasi == "0" && $valid->nim_ketua == $user->nim) {
                      echo "Data Usulan anda sedang dalam proses validasi oleh staff PMW Universitas Sriwijaya";
                    }
                  }
                  ?>
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            <!-- timeline item -->
            <li>
              <i class="fa fa-close (alias) bg-yellow"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Penilaian Tahap Pertama</a></h3>

                <div class="timeline-body">
                <?php
                foreach ($validate->result() as $val)
                  foreach ($tahap_1->result() as $first) {
                    if ($first->kode_usulan == $val->kode_usulan) {
                      echo "Usulan anda dalam proses penilaian oleh reviewer (Penilai Fakultas)";
                    }
                  }

                ?>
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            <!-- timeline item -->
            <li>
              <i class="fa fa-close (alias) bg-yellow"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Penilaian Tahap Akhir</a></h3>

                <div class="timeline-body">
                  Usulan Usaha anda telah diproses penilaian Tahap Akhir
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
