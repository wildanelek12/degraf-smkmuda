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
                <table id="tabelnilai" class="table table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // foreach ($nilai as $row) :
                        ?>
                        <!--
                            <tr>
                                <td><?= $no ?></td>
                                <td>
                                    <?= $row->siswa ?>
                                </td>
                                <td>
                                    <?= $row->nilai ?>
                                </td>
                            </tr>
                        <!?php
                        $no++;
                        endforeach;
                        ?-->
                        <?php
                        $no=1;
                        foreach ($tugas as $row) :
                        ?>
                            <tr>
                                <td><?=$no?></td>
                                <td>
                                    <?= $row->siswa ?>
                                </td>
                                <td>
                                    <?= $row->nilai ?>
                                </td>
                            </tr>
                        <?php
                        $no++;
                        endforeach;
                        ?>
                        <?php
                        $no1=1;
                        foreach ($kuis as $row) :
                        ?>
                            <tr>
                                <td><?=$no1?></td>
                                <td>
                                    <?= $row->siswa ?>
                                </td>
                                <td>
                                    <?= $row->nilai ?>
                                </td>
                            </tr>
                        <?php
                        $no1++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     </div>
    <!-- #END# Basic Examples -->
</div>