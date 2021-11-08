<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    NILAI QUIZ
                </h1>
            </div>

            <div class="body">
                <table class="table table-bordered table-striped table-hover" id="tabel">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>DIMULAI PADA</th>
                            <th>SELESAI PADA</th>
                            <th>JAWABAN</th>
                            <th>NILAI</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kuis as $row) :
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row->siswa ?></td>
                                <td><?= date('H:i / d M Y', strtotime($row->tgl_mulai)) ?></td>
                                <td><?= date('H:i / d M Y', strtotime($row->tgl_selesai)) ?></td>
                                <td>
                                    <?php
                                    $pc_soal = explode(',', $row->soal);
                                    $totalsoal = sizeof($pc_soal);
                                    $soal = $totalsoal;
                                    $jawab = explode(',', $row->jawaban);
                                    foreach ($jawab as $j) {
                                        $pc_dt = explode(":", $j);
                                        $id_soal = $pc_dt[0];
                                        $jawaban = $pc_dt[1];

                                        if ($id_soal != null && $jawaban == null) {
                                            $soal--;
                                        }
                                    }
                                    echo 'Mengerjakan <b>' . $soal . '</b> soal dari <b>' . $totalsoal . '</b> soal<br>Benar <b>' . $row->benar . '</b>';
                                    ?>
                                </td>
                                <td>
                                    <?= $row->nilai ?>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->
</div>