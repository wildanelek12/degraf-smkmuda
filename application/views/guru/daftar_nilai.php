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
                <table id="tabel" class="table table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Tugas / Kuis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tugas as $row) :
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>
                                    <?= $row->nama_tugas ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('guru/detailNilai/' . $row->id_tugas) ?>" title="Detail Pengumpulan" class="btn btn-xs bg-green waves-effect"><i class="material-icons">remove_red_eye</i></a>
                                </td>
                            </tr>
                        <?php
                        $no++;
                        endforeach;
                        ?>
                        <?php
                        
                        foreach ($kuis as $row) :
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>
                                    <?= $row->nama_kuis ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('guru/detailNilai/' . $row->id_kuis) ?>" type="button" title="Hasil Kuis" class="btn btn-xs bg-green waves-effect"><i class="material-icons">remove_red_eye</i></a>
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