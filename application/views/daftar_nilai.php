<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    DAFTAR NILAI SISWA
                </h1>
            </div>

            <div class="body">
                <div class="table-responsive">
                <?php
                if ($this->session->userdata('role') == 1) {
                    redirect('guru/daftarNilai');
                } elseif ($this->session->userdata('role') == 2) {
                    echo '<table id="tabel" class="table table-bordered table-striped table-hover" width="100%">';
                }
                ?>
                <thead>
                    <tr>
                        
                        <th>Nama</th>
                        <th>Tugas / Kuis</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  if ($tugas != null || $kuis != null) {
                        $n_tugas = '';
                        $t = explode(';', $tugas);

                        foreach ($t as $tugas) :
                            $n_tugas .= $tugas . ';';
                        endforeach;

                        $m = substr($n_tugas, 0, -1);
                        $nt = explode(';', $m);

                        foreach ($nt as $tn) {
                            $a = explode(',', $tn);
                            echo '<tr>
                                    <td>' . $a[0] . '</td><td>';

                            for ($i = 0; $i < sizeof($a); $i++) {
                                $b = explode(':', $a[1]);
                                $b0 = $b[0];
                                $b1 = $b[1];
                            }
                            echo $b0 . '<td>' . $b1 . '</td></tr>';
                        }

                        $n_kuis = '';
                        $k = explode(';', $kuis);

                        foreach ($k as $kuis) :
                            $n_kuis .= $kuis . ';';
                        endforeach;

                        $n = substr($n_kuis, 0, -1);
                        $nk = explode(';', $n);

                        foreach ($nk as $kn) {
                            $c = explode(',', $kn);
                            echo '<tr>
                                    <td>' . $c[0] . '</td><td>';

                            for ($i = 0; $i < sizeof($c); $i++) {
                                $d = explode(':', $c[$i]);
                                $d0 = $d[$i];
                                $d1 = $d[$i];
                            }
                            echo $d0 . '<td>' . $d1 . '</td></tr>';
                        }
                  }
                    ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- #END# Basic Examples -->
</div>